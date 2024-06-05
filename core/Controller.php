<?php

namespace core;

class Controller{
    protected Template $template;
    public $isPost=false;
    public $isGet=false;
    public $post;
    public function __construct(){
        $action = Core::getInstance()->actionName;
        $module = Core::getInstance()->moduleName;
        $path="views/{$module}/{$action}.php";
        $this->template=new Template($path);
        switch($_SERVER["REQUEST_METHOD"]){
            case 'POST': $this->isPost=true; break;
            case 'GET': $this->isGet=true; break;
        }
        $this->post = new Post();
    }
    public function render($pathToView){
        $this->template->setTemplateFilePath($pathToView);
        return [
            "Title"=>"Title",
            "Content"=>$this->template->getHTML()
        ];
    }
    public function redirect($path){
        header("Location: {$path}");
        die;
    }
    public function setErrorMessage($message=null){
        $this->template->setParam("errorMessage", $message);
    }
    public function clearErrorMessage(){
        $this->setErrorMessage();
    }
}
<?php

namespace core;

use core\RequestMethods\Get;
use core\RequestMethods\Post;
use JetBrains\PhpStorm\NoReturn;

class Controller{
    protected Template $template;
    public bool $isPost=false;
    public bool $isGet=false;
    public Post $post;
    public Get $get;
    public function __construct(){
        $action = Core::getInstance()->actionName;
        $module = Core::getInstance()->moduleName;
        $path="views/$module/$action.php";
        $this->template=new Template($path);
        switch($_SERVER["REQUEST_METHOD"]){
            case 'POST': $this->isPost=true; break;
            case 'GET': $this->isGet=true; break;
        }
        $this->post = new Post();
        $this->get = new Get();
    }
    public function render($pathToView=null):array{
        if(!empty($pathToView))
            $this->template->setTemplateFilePath($pathToView);
        return [
            "Content"=>$this->template->getHTML()
        ];
    }
    #[NoReturn] public function redirect($path):void{
        header("Location: $path");
        die;
    }
}
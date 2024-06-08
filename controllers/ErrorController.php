<?php
namespace controllers;
use core\Config;
use core\Controller;
class ErrorController extends Controller
{
    public function actionError(array $code):array{
        $num=$this->setRandomError();
        if($code[0]==403){
            $code []=Config::getInstance()->error403;
        }
        $this->template->setParam("code", $code);
        return $this->render("views/errors/error_$num.php");
    }
    private function setRandomError(): int{
        return rand(1, 3);
    }
}
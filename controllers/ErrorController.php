<?php
namespace controllers;
use core\Config;
use core\Controller;
use core\Core;

class ErrorController extends Controller
{
    public function actionError(array $code):array{
        Core::getInstance()->isError = true;
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
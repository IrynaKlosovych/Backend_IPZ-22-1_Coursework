<?php

namespace controllers;

use core\Controller;
use core\Core;

class SiteController extends Controller
{
    public function actionIndex():array{
        if(empty(Core::getInstance()->session->get("email"))){
            return $this->render();
        }
        else{
            return $this->render("views/site/main.php");
        }
    }
}
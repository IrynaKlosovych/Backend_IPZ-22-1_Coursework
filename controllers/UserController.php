<?php

namespace controllers;

use core\Controller;
use core\Core;
use JetBrains\PhpStorm\NoReturn;
use models\Page;
use models\Users;

class UserController extends Controller
{
    public function actionRegistry()
    {
        if (!empty(Core::getInstance()->session->get("email"))) {
            $this->redirect("/");
        }
        if ($this->isPost) {

            $data = file_get_contents("php://input");
            $json = json_decode($data);

            $name = $json->name;
            $surname = $json->surname;
            $pass = $json->password;
            $email = $json->email;

            $num_rows = Users::isLoginExists($email);

            if ($num_rows !== null && $num_rows !== 0) {
                echo Users::$userIsExists;
                exit();
            }

            $user = new Users();
            $user->name = $name;
            $user->surname = $surname;
            $user->password = Users::hashPassword($pass);
            $user->email = $email;
            $user->about = "";
            $user->photo = Users::getRandomAvatar();
            $user->isAdmin = false;
            $user->save();

            $num_rows = Users::isLoginExists($email);
            if ($num_rows !== null && $num_rows > 0) {
                $user->id = Users::getUserId($email);
                Users::addSessionEmail($user->email);
                Users::addSessionID($user->id);
                echo true;
            } else {
                echo false;
            }
            exit;
        } else {
            return $this->render();
        }
    }

    #[NoReturn] public function actionLogin(): void
    {
        if ($this->isPost) {
            $data = file_get_contents("php://input");
            $json = json_decode($data);

            $pass = $json->password;
            $email = $json->email;

            $num_rows = Users::isUserExistsWithEmailAndPass($email, $pass);

            if ($num_rows === null) {
                echo Users::$invalidEmailAndOrPass;
            } else {
                echo true;
                Users::addSessionEmail($email);
                $id = Users::getUserId($email);
                Users::addSessionID($id);
            }
            exit();
        } else
            $this->redirect("/");
    }


    #[NoReturn] public function actionLogout(): void
    {
        if ($this->isPost)
            Users::UserLogout();
        $this->redirect("/");
    }

    #[NoReturn] public function actionDelete(): void
    {
        if ($this->isPost) {
            $id_user = Core::getInstance()->session->get("id");
            Page::setAnotherIDPageForDeletedUser($id_user);
            Users::deleteById($id_user);
            Users::UserLogout();
        }
        $this->redirect("/");
    }


    public function actionUpdate_profile()
    {
        if ($this->isPost) {
            if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK &&
                str_starts_with($_FILES["photo"]["type"], "image/")) {
                $uploadDir = Users::$uploadDirForAvatars;
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $uploadFile = $uploadDir . basename($_FILES["photo"]["name"]);
                move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFile);
            }
            $id_user = Core::getInstance()->session->get("id");
            Users::updatePhotoUser($id_user, basename($_FILES["photo"]["name"]));
            $this->redirect("/");
        } else
            return $this->render();
    }

}
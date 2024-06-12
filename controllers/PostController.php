<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Page;
use models\Post;

class PostController extends Controller
{
    public function actionAdd($title)
    {
        if ($this->isPost) {
            if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK &&
                str_starts_with($_FILES["photo"]["type"], "image/")) {
                $uploadDir = Post::$uploadDir;
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $uploadFile = $uploadDir . basename($_FILES["photo"]["name"]);
                move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFile);
            }
            $post = new Post();
            $post->src=basename($_FILES["photo"]["name"]);
            $post->id_user=Core::getInstance()->session->get("id");
            $post->id_page=Page::getIdByTitle($title[0]);
            $post->save();
            echo "<script>window.location.href = '/page/index/$title[0]';</script>";
        } else {
            $this->redirect("/");
        }
    }
}
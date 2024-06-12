<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Page;
use models\Post;

require_once("searchFile.php");

class PageController extends Controller
{
    public function actionCreate()
    {
        if (empty(Core::getInstance()->session->get("email")))
            $this->redirect("/");
        if ($this->isPost) {
            $data = file_get_contents("php://input");
            $json = json_decode($data);

            $title = $json->title;
            $description = $json->description;
            $rgbHeaderBackground = $json->rgbHeaderBackground;
            $rgbHeaderColor = $json->rgbHeaderColor;
            $rgbFooterBackground = $json->rgbFooterBackground;
            $rgbFooterColor = $json->rgbFooterColor;

            $num_rows = Page::isTitleExists($title);

            if ($num_rows !== null && $num_rows !== 0) {
                echo json_encode(["result" => Page::$pageIsExists]);
                exit();
            }

            $page = new Page();
            $page->title = $title;
            $page->description = $description;
            $page->background_header = $rgbHeaderBackground;
            $page->background_footer = $rgbFooterBackground;
            $page->color_header = $rgbHeaderColor;
            $page->color_footer = $rgbFooterColor;
            $page->id_user = Core::getInstance()->session->get("id");

            $page->save();


            $num_rows = Page::isTitleExists($title);
            if ($num_rows !== null && $num_rows > 0) {
                $data = [
                    "result" => true,
                    "title" => $title
                ];
                echo json_encode($data);
            } else {
                echo json_encode(["result" => false]);
            }
            exit;
        } else
            return $this->render();
    }


    public function actionIndex(array $title = null)
    {
        if ($title !== null && count($title) > 0) {
            $res = Page::isTitleExists($title[0]);
            if ($res === null || $res === 0)
                $this->redirect("/page/index");
            $res = Page::selectAllAboutPageByTitle($title[0]);
            $this->template->setParams(['isGeneral' => false,
                'title' => $title[0],
                'description' => $res[0]["description"],
                'backgroundFooter' => $res[0]['background_footer'],
                'colorTextFooter' => $res[0]['color_footer'],
                'backgroundHeader' => $res[0]['background_header'],
                'colorTextHeader' => $res[0]['color_header']]);
            $res = Post::getPostsForPage($title[0]);
            $posts = [];
            foreach ($res as $result)
                $posts[] = searchFile($result["src"], [Post::$uploadDir]);
            $this->template->setParam('posts', $posts);
        } else {
            $id_user = Core::getInstance()->session->get("id");
            $myPages = Page::getMyPagesTitles($id_user);
            $topAnother = Page::getTopTenPages($id_user);
            $this->template->setParams(['title' => "Сторінки",
                "isGeneral" => true,
                "backgroundFooter" => "",
                "colorTextFooter" => "",
                "myPagesTitles" => $myPages,
                "topAnother" => $topAnother]);
        }
        return $this->render();
    }
}
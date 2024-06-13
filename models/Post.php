<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property int id
 * @property string src
 * @property int id_user
 * @property int id_page
 */
class Post extends Model
{
    protected static string $primaryKey = 'id';
    public static string $table = 'posts';

    public static string $uploadDir= "uploads/img/";
    public static function getPostsForPage(string $title):array{
        return Core::getInstance()->db->createSelect()
            ->select(["src"])
            ->from(static::$table)
            ->join("pages", "pages.id = posts.id_page", "inner join")
            ->where("title", "=", $title)
            ->buildAndExecute();
    }
    public static function setAnotherIDAllPostsOfUser(int $id):void{
        Core::getInstance()->db->createUpdate()
            ->update(static::$table, ["id_user"=>1])
            ->where("id_user", "=", $id)
            ->buildAndExecute();
    }
}
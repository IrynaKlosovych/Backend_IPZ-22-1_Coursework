<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property int id
 * @property int id_user
 * @property string title
 * @property string description
 * @property string background_header
 * @property string background_footer
 * @property string color_header
 * @property string color_footer
 */
class Page extends Model
{
    protected static string $primaryKey = 'id';
    public static string $table = 'pages';
    public static string $pageIsExists = "Уже існує сторінка з такою назвою";
    protected static int $generalAdminIDForPagesWithDeletedUser=1;
    public static function isTitleExists(string $title): int|null
    {
        $sth = Core::getInstance()->db->createSelect()
            ->select(["title"])
            ->from(static::$table)
            ->where("title", "=", $title, "")
            ->buildAndExecute();
        if ($sth === false) {
            return null;
        }
        return count($sth);
    }
    public static function getIdByTitle(string $title): int
    {
        $sth = Core::getInstance()->db->createSelect()
            ->select(["id"])
            ->from(static::$table)
            ->where("title", "=", $title, "")
            ->buildAndExecute();
        return $sth[0]["id"];
    }

    public static function selectAllAboutPageByTitle(string $title):array{
        return Core::getInstance()->db->createSelect()
            ->select(["*"])
            ->from(static::$table)
            ->where("title", "=", $title)
            ->buildAndExecute();
    }
    public static function setAnotherIDPageForDeletedUser(int $id_user):void{
        Core::getInstance()->db->createUpdate()
            ->update(static::$table, ["id_user"=>static::$generalAdminIDForPagesWithDeletedUser])
            ->where("id_user", "=", $id_user)
        ->buildAndExecute();
    }

    public static function getMyPagesTitles(int $userId):array{
        return Core::getInstance()->db->createSelect()->select(["title"])
            ->from(static::$table)
            ->where("id_user", "=", $userId)
            ->buildAndExecute();
    }

    public static function getTopTenPages(int $userId):array{
        return Core::getInstance()->db->createSelect()
            ->select(["id", "title"])
            ->from(static::$table)
            ->where("id_user", "<>", $userId)
            ->orderBy(["rand()"], "")
            ->limit(10)
            ->buildAndExecute();
    }
}
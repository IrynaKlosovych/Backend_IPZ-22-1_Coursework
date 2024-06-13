<?php

namespace models;

use core\Core;
use core\Model;
require_once("searchFile.php");

/**
 * @property int id
 * @property string name
 * @property string surname
 * @property string email
 * @property string password
 * @property string photo
 * @property bool isAdmin
 */
class Users extends Model
{
    protected static string $primaryKey = 'id';
    public static string $table = 'users';
    private const DIRECTORIES = ["uploads/avatars", "public/img"];
    public static string $uploadDirForAvatars = "uploads/avatars/";

    public static string $userIsExists = "Уже є такий акаунт";
    public static string $invalidEmailAndOrPass = "Не правильний логін і/або пароль";

    public static function isLoginExists($email): int|null
    {
        $sth = Core::getInstance()->db->createSelect()
            ->select(["email"])
            ->from(static::$table)
            ->where("email", "=", $email, "")
            ->buildAndExecute();
        if ($sth === false) {
            return null;
        }
        return count($sth);
    }

    public static function getRandomAvatar(): string
    {
        $num = rand(1, 3);
        return "profile_$num.png";
    }

    public static function hashPassword($pass): string
    {
        return md5($pass);
    }

    public static function addSessionEmail($email): void
    {
        Core::getInstance()->session->set("email", $email);
    }
    public static function addSessionID($id): void
    {
        Core::getInstance()->session->set("id", $id);
    }

    public static function isUserExistsWithEmailAndPass(string $email, string $pass):int|null
    {
        $hashPass = md5($pass);
        $sth = Core::getInstance()->db->createSelect()
            ->select(["email", "password"])
            ->from(static::$table)
            ->where("email", "=", $email, "")
            ->andWhere("password", "=", $hashPass)
            ->buildAndExecute();
        if ($sth === false || count($sth) === 0) {
            return null;
        }
        return count($sth);
    }

    public static function searchPhoto(string $email):?string{
        $result = Core::getInstance()->db->createSelect()
            ->select(["photo"])
            ->from(static::$table)
            ->where("email", "=", $email)
            ->buildAndExecute();
        $filename = $result[0]['photo'];
        return searchFile($filename, Users::DIRECTORIES);
    }

    public static function isAdmin(string $email=null):bool{
        if($email===null)
            return "";
        $result = Core::getInstance()->db->createSelect()
            ->select(["isAdmin"])
            ->from(static::$table)
            ->where("email", "=", $email)
            ->buildAndExecute();
        return $result[0]["isAdmin"];
    }
    public static function UserLogout():void{
        Core::getInstance()->session->removeAll();
    }

    public static function getUserId($email){
        $sth = Core::getInstance()->db->createSelect()
            ->select(["id"])
            ->from(static::$table)
            ->where("email", "=", $email, "")
            ->buildAndExecute();
        if ($sth === false) {
            return null;
        }
        return $sth[0]["id"];
    }

    public static function deleteByID($id): void
    {
        parent::deleteByID($id);
    }

    public static function updatePhotoUser(int $id, string $photo):void{
        Core::getInstance()->db->createUpdate()
            ->update(static::$table, ["photo"=>$photo])
            ->where("id", "=", $id)
            ->buildAndExecute();
    }
}
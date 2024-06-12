<?php

use core\Core;
use models\Users;

$this->Title = "Головна";
$userPhoto = Users::searchPhoto(Core::getInstance()->session->get("email"));

?>
<div id="left-menu-panel">
    <div id="user-panel">
        <div><img src="<?= $userPhoto ?>" alt=""></div>
        <div><a href="/user/update_profile">Оновити акаунт</a></div>
    </div>
    <div><a href="/page/index">Переглянути сторінки</a></div>
    <div><a href="/page/create">Створити сторінку</a></div>
    <div><a href="/page/update">Оновити сторінку</a></div>
    <div>
        <form action="/user/logout" method="post">
            <button>Вийти</button>
        </form>
    </div>
    <div>
        <form action="/user/delete" method="post">
            <button>Видалити акаунт</button>
        </form>
    </div>
</div>

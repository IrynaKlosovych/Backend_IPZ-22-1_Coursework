<?php
$this->Title = "Головна/Автентифікація"
?>
<div class="non-logged-main-part">
    <div>
        <div><img src="../../public/img/Inspire.png" alt=""></div>
        <h1>Надихайся, твори, ділись, надихай</h1>
    </div>
    <div>
        <div>
            <div>Ви вже з нами?</div>
            <div id="alertLogin" hidden="hidden"></div>
            <form action="/user/login" method="post" id="loginUser">
                <div>
                    <div><label for="email">Електронна адреса</label></div>
                    <div><input type="email" id="email" name="email" required autocomplete="username"></div>
                </div>
                <div>
                    <div><label for="pass">Пароль</label></div>
                    <div><input type="password" id="pass" name="pass" required autocomplete="current-password"></div>
                </div>
                <button type="submit" id="SubmitLogin">Увійти</button>
            </form>
        </div>
        <div>
            <div>Ще не зареєстровані?</div>
            <div><a href="/user/registry">Пропонуємо зареєструватись</a></div>
        </div>
    </div>
</div>

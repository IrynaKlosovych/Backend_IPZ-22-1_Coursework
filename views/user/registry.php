<?php
$this->Title= "Реєстрація";
?>
<div class="registry">
    <div id="alertRegistry"></div>
    <form action="" method="post" id="registryUser">
        <div>
            <div><label for="name">Ім'я</label></div>
            <div><input type="text" id="name" name="name" required></div>
        </div>
        <div>
            <div><label for="surname">Прізвище</label></div>
            <div><input type="text" id="surname" name="surname" required></div>
        </div>
        <div>
            <div><label for="pass">Пароль</label></div>
            <div><input type="password" id="pass" name="pass" required autocomplete="new-password"></div>
        </div>
        <div>
            <div><label for="pass2">Пароль ще раз, будь ласочка</label></div>
            <div><input type="password" id="pass2" name="pass2" required autocomplete="new-password"></div>
        </div>
        <div>
            <div><label for="email">Електронна адреса</label></div>
            <div><input type="email" id="email" name="email" required autocomplete="username"></div>
        </div>
        <button type="submit" id="SubmitRegistry">Зареєструватись</button>
    </form>
    <div class="sun-registry"></div>
</div>

<?php
$this->Title="Оновити профіль";
?>
<div>
    <div id="updatePhotoUser">
        <div>Змінити profile photo</div>
        <form action="/user/update_profile?>" enctype="multipart/form-data" method="post">
            <div><input type="file" id="photo" name="photo" accept="image/jpeg, image/png"></div>
            <div>
                <button type="submit">Змінити</button>
            </div>
        </form>
    </div>
</div>

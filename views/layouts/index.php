<?php

use core\Config;

/**
 * @var string $Title
 * @var string $Content
 * @var string $backgroundFooter
 * @var string $colorTextFooter
 */

if (empty($Title)) $this->Title = "";
if (empty($Content)) $this->Content = "";
if(empty($backgroundFooter))$this->backgroundFooter="";
if(empty($colorTextFooter))$this->colorTextFooter="";


$name = Config::getInstance()->name;
$surname = Config::getInstance()->surname;
$email = Config::getInstance()->email;
$styleFooter = [];
$styleStringFooter="";
if (!empty($backgroundFooter)&&!empty($colorTextFooter)){
    if($backgroundFooter!=="")
        $styleFooter[]='background-color:'.$backgroundFooter.';';
    if($colorTextFooter!=="")
        $styleFooter[]='color:'. $colorTextFooter.';';
    if(count($styleFooter)!==0){
        $styleStringFooter = implode(' ', $styleFooter);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/style.css">
    <link rel="icon" href="../../public/img/Icon.png" type="image/x-icon" sizes="32x112">
    <script src="../../public/script.js" defer></script>
    <title><?php echo $Title ?></title>
</head>
<body>
<div class="template-div">
    <?php echo $Content ?>
</div>
<footer <?php if($styleStringFooter!=="") echo 'style="'.htmlspecialchars($styleStringFooter).'"'?>>
    <div>
        <div>&copy; <?php echo "$name $surname" ?></div>
        <div><?php echo "$email" ?></div>
    </div>
    <div><a href="/"><img src="../../public/img/Logo.png" alt=""></a></div>
    <div>
        <div>Соціальні мережі:</div>
        <div>
            <div><a href=""><img src="../../public/img/Instagram.png" alt=""></a></div>
            <div><a href=""><img src="../../public/img/YouTube.png" alt=""></a></div>
        </div>
    </div>
</footer>
</body>
</html>
<?php
/**
 * @var array $code
 */
$this->Title = "Помилка $code[0]"
?>
<div class="rainbow-wrapper">
    <div class="red"></div>
    <div class="orange"></div>
    <div class="yellow"></div>
    <div class="green"></div>
    <div class="blue"></div>
    <div class="purple"></div>
    <div class="white">
        <div><?php echo "Помилка " . $code[0] ?></div>
        <div><?php echo $code[1]?></div>
    </div>
</div>
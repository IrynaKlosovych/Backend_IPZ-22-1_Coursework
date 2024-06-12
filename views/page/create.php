<?php
$this->Title = "Створити сторінку";
?>
<div id="createPageTemplate">
    <div id="alertCreatePage"></div>
    <form action="" method="post" id="createPage">
        <div>
            <div><label for="title">Назва</label></div>
            <div><input type="text" id="title" name="title" required></div>
        </div>
        <div>
            <div><label for="description">Опис</label></div>
            <div><input type="text" id="description" name="description" required></div>
        </div>
        <br>
        <div>
            <div>
                <div>Фон назви</div>
                <label for="redRangeBH">Червоний:</label>
                <input type="range" id="redRangeBH" min="0" max="255" value="0">
                <span id="redValueBH">0</span><br>

                <label for="greenRangeBH">Зелений:</label>
                <input type="range" id="greenRangeBH" min="0" max="255" value="0">
                <span id="greenValueBH">0</span><br>

                <label for="blueRangeBH">Синій:</label>
                <input type="range" id="blueRangeBH" min="0" max="255" value="0">
                <span id="blueValueBH">0</span><br>

                <div id="colorDisplayBH" class="color-display"></div>
                <label for="hexValueBH">HEX значення:</label>
                <input type="text" id="hexValueBH" readonly><br>
            </div>
            <div>
                <div>Колір назви</div>
                <label for="redRangeCH">Червоний:</label>
                <input type="range" id="redRangeCH" min="0" max="255" value="0">
                <span id="redValueCH">0</span><br>

                <label for="greenRangeCH">Зелений:</label>
                <input type="range" id="greenRangeCH" min="0" max="255" value="0">
                <span id="greenValueCH">0</span><br>

                <label for="blueRangeCH">Синій:</label>
                <input type="range" id="blueRangeCH" min="0" max="255" value="0">
                <span id="blueValueCH">0</span><br>

                <div id="colorDisplayCH" class="color-display"></div>
                <label for="hexValueCH">HEX значення:</label>
                <input type="text" id="hexValueCH" readonly><br>
            </div>
        </div>
        <br>
        <div>
            <div>
                <div>Фон footer</div>
                <label for="redRangeBF">Червоний:</label>
                <input type="range" id="redRangeBF" min="0" max="255" value="0">
                <span id="redValueBF">0</span><br>

                <label for="greenRangeBF">Зелений:</label>
                <input type="range" id="greenRangeBF" min="0" max="255" value="0">
                <span id="greenValueBF">0</span><br>

                <label for="blueRangeBF">Синій:</label>
                <input type="range" id="blueRangeBF" min="0" max="255" value="0">
                <span id="blueValueBF">0</span><br>

                <div id="colorDisplayBF" class="color-display"></div>
                <label for="hexValueBF">HEX значення:</label>
                <input type="text" id="hexValueBF" readonly><br>
            </div>
            <div>
                <div>Колір footer</div>
                <label for="redRangeCF">Червоний:</label>
                <input type="range" id="redRangeCF" min="0" max="255" value="0">
                <span id="redValueCF">0</span><br>

                <label for="greenRangeCF">Зелений:</label>
                <input type="range" id="greenRangeCF" min="0" max="255" value="0">
                <span id="greenValueCF">0</span><br>

                <label for="blueRangeCF">Синій:</label>
                <input type="range" id="blueRangeCF" min="0" max="255" value="0">
                <span id="blueValueCF">0</span><br>

                <div id="colorDisplayCF" class="color-display"></div>

                <label for="hexValueCF">HEX значення:</label>
                <input type="text" id="hexValueCF" readonly><br>
            </div>
        </div>
        <div><button type="submit" id="SubmitCreatePage">Створити</button></div>
    </form>
</div>

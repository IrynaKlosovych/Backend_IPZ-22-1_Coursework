<?php
/**
 * @var string $title
 * @var string $description
 *
 * @var string $backgroundFooter
 * @var string $colorTextFooter
 * @var string $backgroundHeader
 * @var string $colorTextHeader
 *
 * @var bool $isGeneral
 *
 * @var array $myPagesTitles
 * @var array $topAnother
 *
 * @var array $posts
 */

use core\Core;

$this->Title = $title;
$this->backgroundFooter = $backgroundFooter;
$this->colorTextFooter = $colorTextFooter;
if (empty($myPagesTitles)) $myPagesTitles = [];
if (empty($topAnother)) $topAnother = [];

$styleStringHeader = "";
$styleHeader = [];
if (!empty($backgroundHeader))
    $styleHeader[] = "background-color:$backgroundHeader;";
if (!empty($colorTextHeader))
    $styleHeader[] = "color: $colorTextHeader;";
if (count($styleHeader) !== 0) {
    $styleStringHeader = implode(' ', $styleHeader);
}
?>
<div>
    <?php if ($isGeneral): ?>
        <?php if (Core::getInstance()->session->get("email")): ?>
            <div>Мої сторінки</div>
            <div id="my-pages">
                <?php if (!empty($myPagesTitles) && count($myPagesTitles) > 0): ?>
                    <?php foreach ($myPagesTitles as $title): ?>
                        <div><a href="/page/index/<?php echo $title["title"] ?>"><?php echo $title["title"] ?></a></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    У вас нема створених сторінок
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <div id="another-pages">
            <div>Сторінки інших користувачів</div>
            <div>
                <?php foreach ($topAnother as $title): ?>
                    <div><a href="/page/index/<?php echo $title["title"] ?>"><?php echo $title["title"] ?></a></div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <header <?php echo 'style="' . htmlspecialchars($styleStringHeader) . '"' ?>>
            <h1><?php echo $title ?></h1>
        </header>
        <div id="description">
            <h2><?php echo $description ?></h2>
        </div>
        <div id="createPostForPage">
            <div>Додати пост</div>
            <form action="/post/add/<?php echo $title ?>" enctype="multipart/form-data" method="post">
                <div><input type="file" id="photo" name="photo" accept="image/jpeg, image/png"></div>
                <div>
                    <button type="submit">Додати</button>
                </div>
            </form>
        </div>
        <div id="posts">
            <?php foreach ($posts as $post): ?>
                <div style="border: 1px solid black; width: 9em; height: 9em">
                    <img src="<?php echo $post ?>" alt="" style="width: 8em; height: 8em; place-items: center;">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
</div>

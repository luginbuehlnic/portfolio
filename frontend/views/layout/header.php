<?php

$menu = get_menu_by_slug('main');

$logo = get_globals_logo();

?>

<header data-layout="header">
    <mark>logo</mark>
    <img class="logo" src="<?= $logo['src'] ?>" alt="<?= $logo['alt'] ?>" height="70px"/>
    <nav class="nav_container">
        <ul class="nav">
            <?php foreach ($menu as $item) : ?>
                <li class="nav_item">
                    <a href="<?= $item['url'] ?>" target="<?= $item['target'] ?>">
                        <?= $item['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

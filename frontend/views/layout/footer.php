<?php
$menu = get_menu_by_slug('legals');

$logo = get_globals_logo();

$socials = get_globals_socials();

?>

<footer data-layout="footer">
    <mark>hier kommt der footer</mark>
    <img class="logo" src="<?= $logo['src'] ?>" alt="<?= $logo['alt'] ?>" height="120px"/>
    <div class="socials">
        <?php foreach ($socials as $social) : ?>
            <a href="<?= $social['link'] ?>" target="_blank" aria-label="<?= $social['title'] ?>">
                <img src="<?= $social['icon']['src'] ?>" alt="<?= $social['icon']['alt'] ?>">
            </a>
        <?php endforeach; ?>
    </div>
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
</footer>

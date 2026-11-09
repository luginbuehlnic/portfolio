<?php
$menu = get_menu_by_slug('main');
$logo = get_globals_logo();

// -> aktuelle URL, um den aktiven Menüpunkt zu markieren
global $wp;
$current_url = trailingslashit(home_url($wp->request));
?>

<header data-layout="header">
    <a class="logo_link" href="<?= esc_url(home_url('/')) ?>" aria-label="Startseite">
        <?php if ($logo) : ?>
            <img class="logo" src="<?= esc_url($logo['src']) ?>" alt="<?= esc_attr(get_bloginfo('name')) ?>">
        <?php else : ?>
            <span class="logo_text"><?php bloginfo('name') ?></span>
        <?php endif; ?>
    </a>
    <nav class="nav_container" aria-label="Hauptnavigation">
        <ul class="nav">
            <?php foreach ($menu as $item) :
                $is_current = trailingslashit($item['url']) === $current_url
                    || (is_singular('project') && str_contains($item['url'], '/projekte'));
            ?>
                <li class="nav_item">
                    <a href="<?= esc_url($item['url']) ?>"
                       <?= $item['target'] ? 'target="' . esc_attr($item['target']) . '"' : '' ?>
                       <?= $is_current ? 'aria-current="page"' : '' ?>>
                        <?= esc_html($item['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>

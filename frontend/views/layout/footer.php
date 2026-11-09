<?php
$menu = get_menu_by_slug('legals');
$email = get_globals_email();
$socials = get_globals_socials();
?>

<footer data-layout="footer">
    <div class="contact">
        <?php if ($email) : ?>
            <a href="mailto:<?= esc_attr($email) ?>"><?= esc_html($email) ?></a>
        <?php endif; ?>
        <?php foreach ($socials as $social) : ?>
            <a href="<?= esc_url($social['link']) ?>" target="_blank" rel="noopener"><?= esc_html($social['title']) ?></a>
        <?php endforeach; ?>
    </div>
    <div class="legal">
        <span>© <?= date('Y') ?> <?php bloginfo('name') ?></span>
        <?php foreach ($menu as $item) : ?>
            <a href="<?= esc_url($item['url']) ?>"><?= esc_html($item['title']) ?></a>
        <?php endforeach; ?>
    </div>
</footer>

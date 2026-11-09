<?php
$data = $args['data'];
?>

<section data-module="text-image">
    <img class="image" src="<?= esc_url($data['image']['src']) ?>" alt="<?= esc_attr($data['image']['alt']) ?>" loading="lazy">
    <div class="content">
        <?php if (!empty($data['title'])) : ?>
            <h1 class="title"><?= esc_html($data['title']) ?></h1>
        <?php endif; ?>
        <div class="richtext">
            <?= wpautop($data['text'] ?? '') ?>
        </div>
    </div>
</section>

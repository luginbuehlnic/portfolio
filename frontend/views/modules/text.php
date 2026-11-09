<?php
$data = $args['data'];
?>

<section data-module="text">
    <?php if (!empty($data['title'])) : ?>
        <h1 class="title"><?= esc_html($data['title']) ?></h1>
    <?php endif; ?>
    <div class="richtext">
        <?= wpautop($data['text'] ?? '') ?>
    </div>
</section>

<?php
$data = $args['data'];
$video = $data['video'];
$image = $data['image'];
$project = $data['project'];
?>

<section data-module="hero">
    <?php if ($video) : ?>
        <video class="media" src="<?= esc_url($video['src']) ?>"
               <?= $image ? 'poster="' . esc_url($image['src']) . '"' : '' ?>
               autoplay muted loop playsinline preload="auto" aria-hidden="true"></video>
    <?php elseif ($image) : ?>
        <img class="media" src="<?= esc_url($image['src']) ?>" alt="<?= esc_attr($image['alt']) ?>">
    <?php endif; ?>

    <?php if ($project) : ?>
        <a class="caption" href="<?= esc_url($project['link']) ?>">
            <span class="caption_title"><?= esc_html($project['title']) ?></span>
            <?php if ($project['subtitle']) : ?>
                <span class="caption_subtitle"><?= esc_html($project['subtitle']) ?></span>
            <?php endif; ?>
        </a>
    <?php endif; ?>
</section>

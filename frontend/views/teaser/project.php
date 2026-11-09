<?php
$project = $args['data'];
?>

<a data-teaser="project" href="<?= esc_url($project['link']) ?>">
    <div class="media">
        <?php if ($project['image']) : ?>
            <img src="<?= esc_url($project['image']['src']) ?>" alt="<?= esc_attr($project['image']['alt']) ?>" loading="lazy">
        <?php endif; ?>
        <?php if ($project['preview_video']) : ?>
            <video data-src="<?= esc_url($project['preview_video']['src']) ?>" muted loop playsinline preload="none" aria-hidden="true"></video>
        <?php endif; ?>
    </div>
    <p class="meta">
        <span class="name"><?= esc_html($project['title']) ?></span>
        <?php if ($project['subtitle']) : ?>
            <span class="subtitle"><?= esc_html($project['subtitle']) ?></span>
        <?php endif; ?>
    </p>
</a>

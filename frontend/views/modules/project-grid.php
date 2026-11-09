<?php
$data = $args['data'];
?>

<section data-module="project-grid" style="--columns: <?= (int) ($data['columns'] ?: 2) ?>">
    <?php if (!empty($data['title'])) : ?>
        <h1 class="title"><?= esc_html($data['title']) ?></h1>
    <?php endif; ?>
    <ul class="grid">
        <?php foreach ($data['projects'] as $project) : ?>
            <li>
                <?php get_template_part('frontend/views/teaser/project', null, ['data' => $project]); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

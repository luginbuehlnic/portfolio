<?php
$project = get_project_by_id(get_the_ID());
$next = get_next_project(get_the_ID());
$poster = $project['image_large'];
?>

<main data-page="project">

    <header class="intro">
        <h1 class="title"><?= esc_html($project['title']) ?></h1>
        <p class="info">
            <?php if ($project['subtitle']) : ?><span><?= esc_html($project['subtitle']) ?></span><?php endif; ?>
            <?php if ($project['year']) : ?><span><?= esc_html($project['year']) ?></span><?php endif; ?>
        </p>
    </header>

    <div class="stage">
        <?php if ($project['youtube_id']) : ?>
            <!-- YouTube wird erst nach Klick geladen (Datenschutz, schnellere Seite) -->
            <button class="video_facade" type="button"
                    data-youtube="<?= esc_attr($project['youtube_id']) ?>"
                    aria-label="Video abspielen: <?= esc_attr($project['title']) ?>">
                <?php if ($poster) : ?>
                    <img src="<?= esc_url($poster['src']) ?>" alt="">
                <?php endif; ?>
                <span class="play">Play</span>
            </button>
        <?php elseif ($project['preview_video']) : ?>
            <video src="<?= esc_url($project['preview_video']['src']) ?>"
                   <?= $poster ? 'poster="' . esc_url($poster['src']) . '"' : '' ?>
                   autoplay muted loop playsinline></video>
        <?php elseif ($poster) : ?>
            <img src="<?= esc_url($poster['src']) ?>" alt="<?= esc_attr($poster['alt']) ?>">
        <?php endif; ?>
    </div>

    <section class="details">
        <div class="credits">
            <?php if ($project['credits']) : ?>
                <dl>
                    <?php foreach ($project['credits'] as $credit) : ?>
                        <div>
                            <dt><?= esc_html($credit['role']) ?></dt>
                            <dd><?= esc_html($credit['name']) ?></dd>
                        </div>
                    <?php endforeach; ?>
                </dl>
            <?php endif; ?>
        </div>
        <div class="description">
            <?php if ($project['lead']) : ?>
                <p class="lead"><?= nl2br(esc_html($project['lead'])) ?></p>
            <?php endif; ?>
            <?php if ($project['text']) : ?>
                <div class="richtext"><?= wpautop($project['text']) ?></div>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($project['gallery']) : ?>
        <section class="gallery">
            <?php foreach ($project['gallery'] as $img) : ?>
                <figure class="<?= $img['portrait'] ? 'is-portrait' : 'is-landscape' ?>">
                    <img src="<?= esc_url($img['src']) ?>" alt="<?= esc_attr($img['alt']) ?>" loading="lazy">
                </figure>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <?php if ($next) : ?>
        <nav class="next" aria-label="Nächstes Projekt">
            <!-- <span class="label">Nächstes Projekt</span> -->
            <a href="<?= esc_url($next['link']) ?>"><?= esc_html($next['title']) ?> →</a>
        </nav>
    <?php endif; ?>

</main>

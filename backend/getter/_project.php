<?php

// -> Alle Daten eines Projekts für das Frontend aufbereiten
function get_project_by_id(int $id): array {
    $image_id = carbon_get_post_meta($id, 'image');
    $video_id = carbon_get_post_meta($id, 'preview_video');

    $gallery = [];
    foreach (carbon_get_post_meta($id, 'gallery') ?: [] as $img_id) {
        $meta = wp_get_attachment_metadata($img_id);
        $media = get_media_by_id($img_id, 'xl');
        if (!$media) {
            continue;
        }
        $media['portrait'] = !empty($meta['width']) && $meta['height'] > $meta['width'];
        $gallery[] = $media;
    }

    return [
        'id' => $id,
        'title' => get_the_title($id),
        'link' => get_permalink($id),
        'subtitle' => carbon_get_post_meta($id, 'subtitle'),
        'year' => carbon_get_post_meta($id, 'year'),
        'image' => $image_id ? get_media_by_id($image_id, 'l') : false,
        'image_large' => $image_id ? get_media_by_id($image_id, 'xl') : false,
        'preview_video' => $video_id ? get_media_by_id($video_id) : false,
        'youtube_id' => get_youtube_id(carbon_get_post_meta($id, 'video_url')),
        'lead' => carbon_get_post_meta($id, 'lead'),
        'text' => carbon_get_post_meta($id, 'text'),
        'credits' => carbon_get_post_meta($id, 'credits') ?: [],
        'gallery' => $gallery,
    ];
}

// -> Alle veröffentlichten Projekte (Reihenfolge über «Reihenfolge» im Backend, sonst neueste zuerst)
function get_projects(): array {
    $ids = get_posts([
        'post_type' => 'project',
        'post_status' => 'publish',
        'numberposts' => -1,
        'fields' => 'ids',
        'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
    ]);
    return array_map('get_project_by_id', $ids);
}

// -> Nächstes Projekt (für den Link am Ende der Projektseite), springt am Ende wieder zum ersten
function get_next_project(int $id): array|false {
    $ids = get_posts([
        'post_type' => 'project',
        'post_status' => 'publish',
        'numberposts' => -1,
        'fields' => 'ids',
        'orderby' => ['menu_order' => 'ASC', 'date' => 'DESC'],
    ]);
    if (count($ids) < 2) {
        return false;
    }
    $pos = array_search($id, $ids, true);
    $next = $ids[($pos === false ? 0 : $pos + 1) % count($ids)];
    return [
        'title' => get_the_title($next),
        'link' => get_permalink($next),
    ];
}

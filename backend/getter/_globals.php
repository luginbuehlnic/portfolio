<?php

function get_globals_logo(){
    $logo_id = carbon_get_theme_option('logo');

    $logo = get_media_by_id($logo_id);
    if (!$logo) {
        return false;
    }
    return $logo;
}

function get_globals_socials(): array {
    $socials = carbon_get_theme_option('socials') ?? [];
    foreach ($socials as $key => $social) {
        $socials[$key]['icon'] = get_media_by_id($social['icon'], 'xs');
    }
    return $socials;
}
 
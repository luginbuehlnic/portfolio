<?php

function get_globals_logo(){
    $logo_id = carbon_get_theme_option('logo');
    if (!$logo_id) {
        return false;
    }
    return get_media_by_id($logo_id, 'full');
}

function get_globals_email(): string|false {
    $email = carbon_get_theme_option('email');
    return $email ? sanitize_email($email) : false;
}

function get_globals_socials(): array {
    $socials = carbon_get_theme_option('socials') ?: [];
    foreach ($socials as $key => $social) {
        $socials[$key]['icon'] = !empty($social['icon']) ? get_media_by_id($social['icon'], 'xs') : false;
    }
    return $socials;
}

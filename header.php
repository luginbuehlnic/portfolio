<!DOCTYPE html>
<html lang="<?php bloginfo('language') ?>">
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover" />
    <meta name="theme-color" content="#0e0e0e">
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/frontend/styles/main.css?v=<?= wp_get_theme()->get('Version') ?>">
    <title><?= esc_html(wp_get_document_title()) ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>

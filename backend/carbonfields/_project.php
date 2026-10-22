<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Inhaltsfeld-Konfiguration des Custom Post Type `project`
Container::make('post_meta', 'Projekt')
    ->where('post_type', '=', 'project')
    ->add_fields([
        Field::make('image', 'image', 'Bild')->set_required(true),
        Field::make('textarea', 'description', 'Beschreibung')->set_required(true)->set_help_text('Kurze Beschreibung des Projekts, die auf der Projektübersicht angezeigt wird.'),
        Field::make('textarea', 'lead', 'Lead')->set_required(true),
        Field::make('rich_text', 'text', 'Text')->set_required(true)->set_help_text('Inhalt des Projekts, z.B. eine detaillierte Beschreibung.'),
    ]);
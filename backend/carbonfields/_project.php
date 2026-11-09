<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Inhaltsfeld-Konfiguration des Custom Post Type `project`
Container::make('post_meta', 'Projekt')
    ->where('post_type', '=', 'project')

    // -> Tab 1: Übersicht (wird im Projektraster angezeigt)
    ->add_tab('Übersicht', [
        Field::make('image', 'image', 'Vorschaubild')
            ->set_required(true)
            ->set_help_text('Still im Querformat (16:9), mind. 1600 px breit. Wird in der Übersicht und als Titelbild verwendet.'),
        Field::make('file', 'preview_video', 'Vorschau-Loop (optional)')
            ->set_type(['video'])
            ->set_help_text('Kurzer, stummer MP4-Loop (3–8 Sek., max. ~5 MB). Spielt in der Übersicht beim Darüberfahren ab.'),
        Field::make('text', 'subtitle', 'Untertitel')
            ->set_help_text('Ganz kurz, z. B. «Musikvideo» oder «Dokumentarfilm — Kunde».'),
        Field::make('text', 'year', 'Jahr')
            ->set_width(50),
    ])

    // -> Tab 2: Inhalt der Projektseite
    ->add_tab('Projektseite', [
        Field::make('text', 'video_url', 'YouTube-Link (optional)')
            ->set_help_text('z. B. https://www.youtube.com/watch?v=… — leer lassen bei unveröffentlichten Projekten, dann wird das Vorschaubild bzw. der Loop gezeigt.'),
        Field::make('textarea', 'lead', 'Lead')
            ->set_rows(3)
            ->set_help_text('Ein, zwei Sätze zum Projekt.'),
        Field::make('rich_text', 'text', 'Text'),
        Field::make('complex', 'credits', 'Credits')
            ->add_fields([
                Field::make('text', 'role', 'Rolle')->set_width(50),
                Field::make('text', 'name', 'Name')->set_width(50),
            ])
            ->set_header_template('<%- role %> <% if (name) { %>– <%- name %><% } %>')
            ->set_collapsed(true),
    ])

    // -> Tab 3: Bilder
    ->add_tab('Bilder', [
        Field::make('media_gallery', 'gallery', 'Bildergalerie')
            ->set_type(['image'])
            ->set_help_text('Stills, Behind the Scenes usw. Querformat wird volle Breite, Hochformat erscheint paarweise nebeneinander.'),
    ]);

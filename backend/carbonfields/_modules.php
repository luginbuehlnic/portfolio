<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Konfiguration der verschiedenen Module
Container::make('post_meta', 'Module')
    ->where('post_type', '=', 'page')
    ->add_fields([
        Field::make('complex', 'modules', 'Module')
            // -> hero: Vollbild-Video / -Bild für die Startseite
            ->add_fields('hero', 'Hero (Vollbild)', [
                Field::make('file', 'video', 'Video-Loop (MP4)')
                    ->set_type(['video'])
                    ->set_help_text('Stumm, 10–20 Sek., max. ~10 MB. Wird automatisch und in Schleife abgespielt.'),
                Field::make('image', 'image', 'Bild / GIF')
                    ->set_help_text('Wird angezeigt, solange das Video lädt, oder statt des Videos, wenn keines gesetzt ist.'),
                Field::make('association', 'project', 'Verlinktes Projekt (optional)')
                    ->set_types([['type' => 'post', 'post_type' => 'project']])
                    ->set_max(1)
                    ->set_help_text('Titel und Link erscheinen unten links im Bild.'),
            ])
            // -> project_grid: Übersicht aller Projekte
            ->add_fields('project_grid', 'Projektübersicht', [
                Field::make('text', 'title', 'Titel (optional)'),
                Field::make('select', 'columns', 'Spalten')
                    ->set_options(['2' => '2 Spalten', '3' => '3 Spalten'])
                    ->set_default_value('2'),
            ])
            // -> text: Fliesstext (Über mich, Impressum, Datenschutz)
            ->add_fields('text', 'Text', [
                Field::make('text', 'title', 'Titel'),
                Field::make('rich_text', 'text', 'Text'),
            ])
            // -> text_image: Text mit Bild (z. B. Porträt auf «Über mich»)
            ->add_fields('text_image', 'Text mit Bild', [
                Field::make('image', 'image', 'Bild')->set_required(),
                Field::make('text', 'title', 'Titel'),
                Field::make('rich_text', 'text', 'Text'),
            ])
            // todo: add new modules here
            // -> SETTINGS
            ->set_layout('tabbed-vertical')
    ]);

// -> Funktion, um die Module und die entsprechenden Templates auf der Seite zu laden
function render_modules (): void {
    $modules = carbon_get_the_post_meta('modules');
    if (empty($modules)) {
        return;
    }
    foreach ($modules as $module) {
        // -> Modifiziere die Daten des Moduls, falls nötig, basierend auf dem Modultyp
        switch ($module['_type']) {
            case 'hero':
                $module['video'] = $module['video'] ? get_media_by_id($module['video']) : false;
                $module['image'] = $module['image'] ? get_media_by_id($module['image'], 'xl') : false;
                $module['project'] = !empty($module['project'])
                    ? get_project_by_id((int) $module['project'][0]['id'])
                    : false;
                break;
            case 'project_grid':
                $module['projects'] = get_projects();
                break;
            case 'text_image':
                $module['image'] = get_media_by_id($module['image'], 'l');
                break;
            // todo: add data modifications for modules here as a new case
        }
        // -> Laden des Templates basierend auf dem Modultyp und weitergeben der Daten
        get_template_part(
            'frontend/views/modules/' . str_replace('_', '-', $module['_type']),
            null,
            [
                'data' => $module
            ]
        );
    }
}

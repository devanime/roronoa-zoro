<?php
/**
 * Override VC functions here.
 * @version 1.0
 */

function vc_shortcodes_theme_templates_dir($template)
{
    static $templates = [];
    if (!isset($templates[$template])) {
        $locations = [
            'templates/modules/' . $template,
            'templates/components/' . $template,
            'templates/' . $template,
            'vc_template/' . $template
        ];
        $locations = apply_filters('devanime/roronoa-zoro/template_locations', $locations, $template);
        $templates[$template] = locate_template($locations);
    }

    return $templates[$template];
}

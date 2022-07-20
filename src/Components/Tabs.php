<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\ParentComponent;
use DevAnime\RoronoaZoro\Views\TabsView;

/**
 * Class Tabs
 * @package DevAnime\RoronoaZoro\Components
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class Tabs extends ParentComponent
{
    const NAME = 'Tabs';
    const TAG = 'tabs';
    const VIEW = TabsView::class;

    protected $component_config = [
        'description' => 'Create a set of tabs.',
        'show_settings_on_create' => true,
        'is_container' => true,
        'content_element' => true,
        'js_view' => 'VcColumnView',
        'category' => 'Structure',
        'params' => [
            'format' => [
                'type' => 'dropdown',
                'heading' => 'Format',
                'param_name' => 'format',
                'value' => [
                    'Buttons' => 'buttons',
                    'Text' => 'text'
                ]
            ],
            'style' => [
                'type' => 'dropdown',
                'heading' => 'Style',
                'param_name' => 'style',
                'value' => [
                    'Default' => '',
                    'Secondary' => 'secondary',
                    'Inverted' => 'inverted'
                ]
            ],
            'layout' => [
                'type' => 'dropdown',
                'heading' => 'Layout',
                'param_name' => 'layout',
                'value' => [
                    'Horizontal' => 'horizontal',
                    'Dropdown on Mobile' => 'default',
                    'Dropdown Only' => 'dropdown'
                ]
            ]
        ]
    ];
}

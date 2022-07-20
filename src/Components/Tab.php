<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\ChildComponent;
use DevAnime\RoronoaZoro\Views\TabView;

/**
 * Class Tab
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class Tab extends ChildComponent
{
    const NAME = 'Tab';
    const TAG = 'tab';
    const VIEW = TabView::class;
    protected $parent = 'tabs';

    protected $component_config = [
        'description' => 'Create a tab.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            [
                'type' => 'textfield',
                'heading' => 'Title',
                'param_name' => 'title',
                'value' => '',
                'group' => 'Content',
                'description' => 'Set the tab title.',
                'admin_label' => true
            ],
            [
                'type' => 'textfield',
                'heading' => 'Url',
                'param_name' => 'url',
                'value' => '',
                'description' => 'Set the tab url.',
                'admin_label' => true,
                'group' => 'Content'
            ]
        ]
    ];
}

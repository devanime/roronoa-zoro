<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Support\Component;
use DevAnime\View\Element;

/**
 * Class Heading
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class Heading extends Component
{
    const NAME = 'Heading';
    const TAG = 'heading';

    protected $component_config = [
        'description' => 'Create a heading.',
        'icon' => 'icon-wpb-atm',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            [
                'type' => 'textfield',
                'heading' => 'Text',
                'param_name' => 'content',
                'description' => 'Set the heading text.',
                'group' => 'General',
                'admin_label' => true
            ],
            [
                'type' => 'dropdown',
                'heading' => 'Tag',
                'param_name' => 'tag',
                'value' => [
                    'H2' => 'h2',
                    'H3' => 'h3',
                    'H4' => 'h4',
                    'H1' => 'h1'
                ],
                'description' => 'Set the heading tag [H1 -> H4]. This is for accessibility purposes only, this will not affect appearance. H1 should only be used once at the top of the page (if page title is not automatically added).',
                'group' => 'General',
                'admin_label' => true
            ],
            [
                'type' => 'dropdown',
                'heading' => 'Size',
                'param_name' => 'size',
                'description' => 'Set the heading size.',
                'value' => [
                    'Default' => 'default',
                    'Medium' => 'medium',
                    'Large' => 'large',
                    'Extra Large' => 'xlarge'
                ],
                'group' => 'General',
                'admin_label' => true
            ],
            [
                'type' => 'textfield',
                'heading' => 'Extra class modifier',
                'param_name' => 'el_class',
                'edit_field_class' => 'vc_col-xs-12 vc_deprecated_text',
                'description' => 'Deprecated - use "Extra class name" instead.',
                'group' => 'General'
            ],
            [
                'type' => 'textfield',
                'heading' => 'Extra class name',
                'param_name' => 'el_class_2',
                'group' => 'General'
            ]
        ]
    ];

    protected function createView(array $atts)
    {
        $classes = Util::componentClasses(static::TAG, [$atts['size'], $atts['el_class']]) . ' ' . $atts['el_class_2'];
        $classes = implode(' ', array_unique(array_filter(explode(' ', $classes))));
        return Element::create($atts['tag'], $atts['content'], ['class' => $classes]);
    }
}

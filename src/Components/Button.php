<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Support\Component;
use DevAnime\View\Link;

/**
 * Class Button
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class Button extends Component
{
    const FULL_WIDTH_CLASS = 'block';

    const NAME = 'Button';
    const TAG = 'button';

    protected static $default_styles = [
        'Select Style' => '',
        'Secondary' => 'secondary',
        'Inverted' => 'inverted'
    ];

    protected $component_config = [
        'description' => 'Create a button link.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            'link' => [
                'type' => 'vc_link',
                'heading' => 'Link',
                'param_name' => 'link',
                'description' => 'Enter link attributes.',
                'admin_label' => true
            ],
            'style' => [
                'type' => 'dropdown',
                'heading' => 'Alternative Button Style',
                'param_name' => 'style',
                'description' => 'Style button different from the default.',
                'value' => ''
            ],
            'width' => [
                'type' => 'checkbox',
                'heading' => 'Full Width',
                'param_name' => 'full_width',
                'description' => 'Make the button fill the width of its container.'
            ],
            [
                'type' => 'textfield',
                'heading' => 'Extra class name',
                'param_name' => 'el_class',
                'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
            ]
        ]
    ];

    protected function setupConfig()
    {
        parent::setupConfig();
        $this->setStyles();
    }

    protected function createView(array $atts)
    {
        $link = vc_build_link($atts['link']);
        $link['title'] = apply_filters('devanime/roronoa-zoro/button/title', $link['title'], $atts['style']);
        $Link = Link::createFromField($link);
        $classes = Util::componentClasses(static::TAG, [
            $atts['style'],
            $atts['full_width'] ? static::FULL_WIDTH_CLASS : ''
        ]);
        $classes = implode(' ', array_filter(array_unique(array_map('trim', array_merge(
            explode(' ', $classes ?: ''),
            explode(' ', $atts['el_class'] ?? '')
        )))));

        return $Link->class($classes);
    }

    protected function setStyles()
    {
        $this->component_config['params']['style']['value'] = apply_filters('devanime/roronoa-zoro/button/styles', static::$default_styles);
    }

}

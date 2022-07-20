<?php

namespace DevAnime\RoronoaZoro\Components;
use DevAnime\Estarossa\Modal\ModalView;
use DevAnime\RoronoaZoro\Support\Component;

/**
 * Class ModalComponent
 * @package Theme
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class Modal extends Component
{
    const DEFAULT_TYPE = 'box';

    const NAME = 'Modal';
    const TAG = 'modal';

    protected $component_config = [
        'description' => 'Create a static modal that can be referenced from a CTA.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            [
                'type' => 'textfield',
                'heading' => 'ID',
                'param_name' => 'id',
                'value' => '',
                'description' => 'Please omit the hashtag. This is the field that gets referenced from a CTA.',
                'admin_label' => true
            ],
            [
                'type' => 'dropdown',
                'heading' => 'Types',
                'param_name' => 'type',
                'value' => [
                    '-- Select A Type --' => '',
                    'Box' => 'box',
                    'Centered' => 'centered'
                ],
                'description' => 'Select the type of modal.',
                'admin_label' => true
            ],
            [
                'type' => 'textarea_html',
                'heading' => 'Content',
                'param_name' => 'content',
                'value' => '',
                'description' => ''
            ]
        ]
    ];

    protected function loadTemplate($atts, $content = null)
    {
        $content = wpb_js_remove_wpautop($content);
        ModalView::load(
            $atts['id'],
            $atts['type'] ?: static::DEFAULT_TYPE,
            $content,
            true
        );
    }
}

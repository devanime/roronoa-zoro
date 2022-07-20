<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\Component;
use DevAnime\RoronoaZoro\Views\CalloutView;

/**
 * Class Callout
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class Callout extends Component
{
    const NAME = 'Callout';
    const TAG = 'callout';
    const VIEW = CalloutView::class;

    protected $component_config = [
        'description' => 'WYSIWYG with option for button.',
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
                'description' => 'Enter the title of the callout.',
                'group' => 'Content',
                'admin_label' => true
            ],
            [
                'type' => 'textarea_html',
                'heading' => 'Content',
                'param_name' => 'content',
                'value' => '',
                'description' => 'Enter the content of the callout.',
                'group' => 'Content'
            ],
            [
                'type' => 'attach_image',
                'heading' => 'Image',
                'param_name' => 'image_id',
                'value' => '',
                'description' => 'Set the image for this callout.',
                'group' => 'Image'
            ],
            [
                'type' => 'textfield',
                'heading' => 'Title',
                'param_name' => 'button_title',
                'value' => '',
                'description' => 'Enter the title of the button in the callout',
                'group' => 'Button'
            ],
            [
                'type' => 'textfield',
                'heading' => 'URL',
                'param_name' => 'button_url',
                'value' => '',
                'description' => 'Enter the url of the button in the callout',
                'group' => 'Button'
            ],
            [
                'type' => 'textfield',
                'heading' => 'Event Tracking',
                'param_name' => 'button_event_tracking',
                'value' => '',
                'description' => '',
                'group' => 'Button'
            ],
            [
                'type' => 'checkbox',
                'heading' => 'Open in new window?',
                'param_name' => 'button_target',
                'value' => '',
                'description' => '',
                'group' => 'Button'
            ],
            [
                'type' => 'checkbox',
                'heading' => 'Options',
                'param_name' => 'options',
                'group' => 'Options',
                'value' => [
                    'Include an image.' => 'media',
                ],
                'description' => 'Component Options',
            ]
        ]
    ];
}

<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Estarossa\ContentBlock\ContentBlockView;
use DevAnime\RoronoaZoro\Support\Component;

/**
 * Class ContentBlock
 * @package DevAnime\RoronoaZoro\Components;
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ContentBlock extends Component
{
    const NAME = 'Content Block';
    const TAG = 'content_block';
    const VIEW = ContentBlockView::class;

    protected $component_config = [
        'description' => 'Enter headline and content with optional tagline and CTA.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            [
                'type' => 'textfield',
                'heading' => 'Headline',
                'param_name' => 'headline',
                'value' => '',
                'description' => 'Enter a headline.',
                'group' => 'General',
                'admin_label' => true
            ],
            [
                'type' => 'dropdown',
                'heading' => 'Headline Tag',
                'param_name' => 'tag',
                'value' => [
                    'H2' => 'h2',
                    'H3' => 'h3'
                ],
                'description' => 'Set the heading tag for the headline.',
                'group' => 'General',
                'admin_label' => true
            ],
            [
                'type' => 'textfield',
                'heading' => 'Tagline',
                'param_name' => 'tagline',
                'value' => '',
                'description' => 'Enter a tagline.',
                'group' => 'General'
            ],
            [
                'type' => 'textarea_html',
                'heading' => 'Content',
                'param_name' => 'content',
                'value' => '',
                'description' => 'Enter content.',
                'group' => 'General'
            ],
            [
                'type' => 'vc_link',
                'heading' => 'Call To Action',
                'param_name' => 'cta',
                'value' => '',
                'description' => 'Enter call to action.',
                'group' => 'General'
            ],
            [
                'type' => 'checkbox',
                'heading' => 'Options',
                'param_name' => 'class_modifiers',
                'group' => 'Options',
                'value' => [
                    'Secondary CTA' => 'secondary-cta',
                    'Left Align' => 'left',
                    'Full Column Height' => 'full-col-height',
                    'Narrow' => 'narrow'
                ],
                'description' => 'Layout controls.'
            ]
        ]
    ];

    protected function createView(array $atts)
    {
        $atts['cta'] = vc_build_link($atts['cta']);
        $atts['class_modifiers'] = explode(',', $atts['class_modifiers']);
        return parent::createView($atts);
    }
}

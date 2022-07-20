<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\ChildComponent;
use DevAnime\RoronoaZoro\Views\ContentHeaderLinkView;

/**
 * Class ContentHeaderLink
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $title
 * @property string $url
 */
class ContentHeaderLink extends ChildComponent
{
    const NAME = 'Link';
    const TAG = 'content_header_link';
    const VIEW = ContentHeaderLinkView::class;
    protected $parent = 'content_header';

    protected $component_config = [
        'description' => 'Add a link to the content header.',
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
                'description' => 'Set the title.',
                'admin_label' => true
            ],
            [
                'type' => 'textfield',
                'heading' => 'Url',
                'param_name' => 'url',
                'value' => '',
                'description' => 'Set the url',
                'admin_label' => true
            ]
        ]
    ];
}

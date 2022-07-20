<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\ChildComponent;
use DevAnime\RoronoaZoro\Views\ContentHeaderHeadlineView;

/**
 * Class ContentHeaderHeadline
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ContentHeaderHeadline extends ChildComponent
{
    const NAME = 'Headline';
    const TAG = 'content_header_headline';
    const VIEW = ContentHeaderHeadlineView::class;
    protected $parent = 'content_header';

    protected $component_config = [
        'description' => 'Add content headline.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            'headline' => [
                'type' => 'textfield',
                'heading' => 'Headline',
                'param_name' => 'headline',
                'value' => '',
                'group' => 'General',
                'description' => 'Set a headline',
                'admin_label' => true
            ],
            'tags' => [
                'type' => 'dropdown',
                'heading' => 'Tag',
                'param_name' => 'tag',
                'value' => [],
                'description' => 'Select a tag. Default to h2.',
                'group' => 'General',
            ],
        ]
    ];

    protected function populateConfigOptions()
    {
        $this->setTags();
    }

    protected function setTags()
    {
        $options = apply_filters('devanime/roronoa-zoro/content-header-headline/tags', [
            'H1' => 'h1',
            'H2' => 'h2',
            'H3' => 'h3',
            'H4' => 'h4',
            'H5' => 'h5',
            'H6' => 'h6',
        ]);
        $this->component_config['params']['tags']['value'] = array_merge(['-- Select Tag --' => ''], $options);
    }
}

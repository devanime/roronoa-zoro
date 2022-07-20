<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Estarossa\Accordion\AccordionPanelView;
use DevAnime\RoronoaZoro\Support\BlockComponent;

/**
 * Class BlockAccordionPanel
 * @package DevAnime\RoronoaZoro\Components
 */
class BlockAccordionPanel extends BlockComponent
{
    const NAME = 'Block Accordion Panel';
    const TAG = 'block_accordion_panel';
    const VIEW = AccordionPanelView::class;

    protected $parent = 'accordion';

    protected $component_config = [
        'description' => 'Block Accordion Panel',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            'block_post' => [],
            'heading' => [
                'type' => 'textfield',
                'heading' => 'Heading Override',
                'param_name' => 'heading',
                'description' => 'Uses Block\'s post title if not set',
                'value' => '',
                'group' => 'Content',
                'admin_label' => true
            ],
            [
                'type' => 'checkbox',
                'heading' => 'Expanded by default?',
                'description' => 'If checked the accordion panel will be expanded on page load',
                'param_name' => 'expanded',
                'value' => [
                    'Yes' => 'yes',
                ],
                'group' => 'Content',
                'admin_label' => true
            ]
        ]
    ];

    protected function createView(array $atts)
    {
        /* @var AccordionPanelView $View */
        $ViewClass = static::VIEW;
        $block = get_post($atts['block_id']);
        if ($block && empty($atts['heading'])) {
            $atts['heading'] = get_the_title($block);
        }
        $View = new $ViewClass($atts['heading'], $atts['content']);
        if ($atts['expanded']) {
            $View->expand();
        }
        return $View;
    }
}

<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Estarossa\Accordion\AccordionPanelView;
use DevAnime\RoronoaZoro\Support\ChildComponent;

/**
 * Class AccordionPanel
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class AccordionPanel extends ChildComponent
{
    const NAME = 'Accordion Panel';
    const TAG = 'accordion_panel';
    const VIEW = AccordionPanelView::class;

    protected $parent = 'accordion';

    protected $component_config = [
        'description' => 'Accordion Panel',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            [
                'type' => 'textfield',
                'heading' => 'Heading',
                'param_name' => 'heading',
                'value' => '',
                'group' => 'Content',
                'admin_label' => true
            ],
            [
                'type' => 'textarea_html',
                'heading' => 'Content',
                'param_name' => 'content',
                'value' => '',
                'group' => 'Content'
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
        $View = new $ViewClass($atts['heading'], $atts['content']);
        if ($atts['expanded']) {
            $View->expand();
        }
        return $View;
    }
}

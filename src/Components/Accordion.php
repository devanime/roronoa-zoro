<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Estarossa\Accordion\AccordionView;
use DevAnime\RoronoaZoro\Support\ParentComponent;
use DevAnime\View\ViewCollection;

/**
 * Class Accordion
 * @package DevAnime\RoronoaZoro\Components
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class Accordion extends ParentComponent
{
    const NAME = 'Accordion';
    const TAG = 'accordion';
    const VIEW = AccordionView::class;

    protected $component_config = [
        'description' => 'Create accordion.',
        'is_container' => true,
        'content_element' => true,
        'js_view' => 'VcColumnView',
        'category' => 'Structure',
        'params' => [
            [
                'type' => 'dropdown',
                'heading' => 'Heading Level',
                'param_name' => 'heading_level',
                'value' => [
                    '-- Select Heading Level -- ' => '',
                    'H2' => 'h2',
                    'H3' => 'h3',
                    'H4' => 'h4',
                    'H5' => 'h5',
                ],
                'description' => 'Set the heading level of the panel headlines. Default H2.',
                'admin_label' => true
            ],
            [
                'type' => 'checkbox',
                'heading' => 'Single View',
                'param_name' => 'single_open',
                'description' => 'Only one panel open at a time.'
            ]
        ]
    ];

    protected function loadTemplate($atts, $content = null)
    {
        /* @var ViewCollection $content */
        return $this->createView([
            'content' => $content->getAll(),
            'heading_level' => $atts['heading_level'],
            'single_open' => $atts['single_open'],
        ]);
    }

    /**
     * @param array $atts
     * @return mixed
     */
    protected function createView(array $atts)
    {
        /* @var AccordionView $ViewClass */
        $ViewClass = static::VIEW;
        $View = new $ViewClass($atts['content']);
        if ($atts['single_open']) {
            $View->setSingleOpen(true);
        }
        $icon = apply_filters('devanime/roronoa-zoro/accordion-icon', [], $this);
        if (! empty($icon)) {
            $View->setIcon($icon);
        }
        return $atts['heading_level'] ? $View->setHeadlineElement($atts['heading_level']) : $View;
    }
}

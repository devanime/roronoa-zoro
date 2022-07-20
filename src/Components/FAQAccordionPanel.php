<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Producers\FAQ\FAQ;
use DevAnime\Producers\FAQ\FAQRepository;
use DevAnime\Estarossa\Accordion\AccordionPanelView;
use DevAnime\RoronoaZoro\Support\ChildComponent;

/**
 * Class FAQAccordionPanel
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class FAQAccordionPanel extends ChildComponent
{
    const NAME = 'FAQ Accordion Panel';
    const TAG = 'faq_accordion_panel';
    const VIEW = AccordionPanelView::class;

    protected $parent = 'accordion';

    protected $component_config = [
        'description' => 'FAQ Accordion Panel',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'js_view'  => 'vcAdminPostTitle',
        'params' => [
            'faq_post' => [
                'type' => 'dropdown',
                'heading' => 'FAQ',
                'param_name' => 'faq_id',
                'description' => 'Select FAQ.',
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

    protected function populateConfigOptions()
    {
        $this->setFAQPostsParam();
    }

    protected function setFAQPostsParam()
    {
        $options['-- Select FAQ --'] = '';
        $Repository = new FaqRepository();
        $faqs = $Repository->findAll();
        foreach($faqs as $FAQ) { /* @var FAQ $FAQ */
            $options[$FAQ->title()] = $FAQ->ID;
        }
        $this->component_config['params']['faq_post']['value'] = $options;
    }

    protected function createView(array $atts)
    {
        /* @var AccordionPanelView $ViewClass */
        $ViewClass = static::VIEW;
        $faq = new FAQ($atts['faq_id']);
        do_action('estarossa/schema/register/faqpage', $faq);
        $View = $ViewClass::createFromPost($faq);
        $View->elementAttributes(['data-gtm' => 'faq']);
        if ($atts['expanded']) {
            $View->expand();
        }
        return $View;
    }
}

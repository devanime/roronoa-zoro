<?php

namespace DevAnime\RoronoaZoro\Support;
use DevAnime\RoronoaZoro\Components;

/**
 * Class ComponentRegistry
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ComponentRegistry
{
    private $components = [
        Components\VcSection::class,
        Components\VcRow::class,
        Components\VcRowInner::class,
        Components\VcColumn::class,
        Components\VcColumnInner::class,
        Components\VcColumnText::class,
        Components\VcSingleImage::class,
        Components\Callout::class,
        Components\ImageCarousel::class,
        Components\Tabs::class,
        Components\Tab::class,
        Components\Slide::class,
        Components\Slider::class,
        Components\ContentBlock::class,
        Components\ContentHeader::class,
        Components\ContentHeaderHeadline::class,
        Components\ContentHeaderLink::class,
        Components\Accordion::class,
        Components\AccordionPanel::class,
        Components\FAQAccordionPanel::class,
        Components\BlockAccordionPanel::class,
        Components\Video::class,
        Components\SubNav::class,
        Components\TicketCalendar::class,
        Components\TalentCard::class,
        Components\MediaCarousel::class,
        Components\Blockquote::class,
        Components\Button::class,
        Components\Heading::class,
        Components\Modal::class,
        Components\ResponsiveSpacer::class
    ];

    public function __construct()
    {
        foreach($this->components as $component) {
            if (class_exists($component)) {
                $component = new $component;
                if (method_exists($component, 'register')) {
                    $component->register();
                }
            }
        }
    }
}

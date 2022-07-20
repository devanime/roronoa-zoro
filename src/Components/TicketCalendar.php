<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\Component;

/**
 * Class TicketCalendar
 * @package Theme\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class TicketCalendar extends Component
{
    const SHORTCODE_FORMAT = '[ticket-calendar view="%s"]';
    const CALENDAR_VIEW_DEFAULT = 'accordion';
    const NAME = 'Ticket Calendar';
    const TAG = 'ticket_calendar';

    protected $component_config = [
        'description' => 'Upcoming/Full Calendar Views.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            'view' => [
                'type' => 'dropdown',
                'heading' => 'Select View',
                'param_name' => 'view',
                'value' => [
                    '-- Select View ---' => '',
                    'Upcoming' => 'upcoming',
                    'Full' => 'accordion'
                ],
                'description' => 'Default: Full',
                'admin_label' => true

            ]
        ]
    ];

    protected function createView(array $atts)
    {
        return do_shortcode(sprintf(static::SHORTCODE_FORMAT, $atts['view'] ?: static::CALENDAR_VIEW_DEFAULT));
    }
}

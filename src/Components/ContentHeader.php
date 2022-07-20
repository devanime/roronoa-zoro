<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\ParentComponent;
use DevAnime\RoronoaZoro\Views\ContentHeaderView;

/**
 * Class ContentHeader
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ContentHeader extends ParentComponent
{
    const NAME = 'Content Header';
    const TAG = 'content_header';
    const VIEW = ContentHeaderView::class;
    protected $children = ['tabs'];

    protected $component_config = [
        'description' => 'Set up any combination of heading text, link and tabs.',
        'show_settings_on_create' => false,
        'is_container' => true,
        'content_element' => true,
        'js_view' => 'VcColumnView',
        'category' => 'Structure',
        'params' => []
    ];
}

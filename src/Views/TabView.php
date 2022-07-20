<?php

namespace DevAnime\RoronoaZoro\Views;

/**
 * Class TabView
 * @package Theme\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $title
 * @property string $url
 * @property string $group_id
 */
class TabView extends TemplateView
{
    protected $name = 'tab';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/tab";
}

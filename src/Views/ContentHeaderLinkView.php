<?php

namespace DevAnime\RoronoaZoro\Views;

/**
 * Class ContentLinkView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $title
 * @property string $url
 */
class ContentHeaderLinkView extends TemplateView
{
    protected $name = 'content-header-link';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/content-header-link";
}

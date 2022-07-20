<?php

namespace DevAnime\RoronoaZoro\Views;

/**
 * Class ContentHeaderHeadlineView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $headline
 * @property string $tag
 */
class ContentHeaderHeadlineView extends TemplateView
{
    const TAG = 'h2';
    protected $name = 'content-header-headline';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/content-header-headline";

    public function __construct(array $atts = [])
    {
        parent::__construct($atts);
        $this->tag ?: static::TAG;
    }
}

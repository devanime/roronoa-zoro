<?php

namespace DevAnime\RoronoaZoro\Support;
use DevAnime\View\ViewCollection;

/**
 * Class ParentComponent
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ParentComponent extends ComponentContainer
{
    protected $init_priority = 20;
    protected $children = [];

    protected function setupConfig()
    {
        parent::setupConfig();
        $children = apply_filters('devanime/roronoa-zoro/children/' . static::TAG, $this->children);
        $this->component_config['as_parent'] = ['only' => implode(',', $children)];
    }

    protected function content($atts, $content = null) {
        $children = array_filter(explode(static::$DELIMITER, wpb_js_remove_wpautop($content)));
        $content = new ViewCollection(array_map('unserialize', $children));
        return $this->loadTemplate($atts, $content);
    }
}

<?php

namespace DevAnime\RoronoaZoro\Support;

use DevAnime\View\View;
use DevAnime\View\ViewCollection;

/**
 * Trait ComponentViewTrait
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
trait ComponentViewTrait
{
    protected static $serialize = false;
    protected static $DELIMITER = '@@serialized-child@@';
    /**
     * @param $atts
     * @param string|ViewCollection|null $content
     * @return View
     */
    protected function loadTemplate($atts, $content = null)
    {
        $atts = vc_map_get_attributes(static::TAG, $atts);
        $atts['content'] = $content;
        $atts = $this->formatAttributeValues($atts);
        return $this->createView($atts);
    }

    /**
     * @param array $atts
     * @return mixed
     */
    protected function createView(array $atts)
    {
        $ViewClass = static::VIEW;
        return new $ViewClass($atts);
    }

    protected function formatAttributeValues(array $atts)
    {
        $format_content = empty($this->component_config['is_container']);
        foreach ($this->component_config['params'] ?? [] as $param) {
            $key = $param['param_name'] ?? false;
            if (empty($atts[$key])) {
                continue;
            }
            if (in_array($param['type'], ['textfield', 'textarea']) && strpos($key, 'el_class') === false ) {
                $atts[$key] = trim(convert_chars(wptexturize($atts[$key])));
            }
            if ($key == 'content' && $param['type'] != 'textarea_html') {
                $format_content = false;
            }

        }
        if (is_string($atts['content'])) {
            $atts['content'] = wpb_js_remove_wpautop($atts['content'], $format_content);
        }
        return $atts;
    }

    protected function content($atts, $content = null)
    {
        $View = $this->loadTemplate($atts, $content);

        return static::$serialize ? serialize($View) . static::$DELIMITER : $View;
    }
}

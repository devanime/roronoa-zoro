<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Util;

/**
 * Class VcColumnTextView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $el_id
 * @property string $css
 * @property array $options
 * @property array $atts
 * @property array $classes
 * @property array $attributes
 */
class VcColumnTextView extends TemplateView
{
    protected $name = 'column-text';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/column-text";

    public function __construct(array $atts = [])
    {
        parent::__construct($atts);
        if ($this->el_id) {
            $this->atts['id'] = $this->el_id;
        }
        if ($this->css) {
            $this->classes[] = vc_shortcode_custom_css_class($this->css);
        }
        if (!empty($classes = array_filter(array_merge($this->classes, (array)$this->options)))) {
            $this->atts['class'] = $classes;
        }
        $this->attributes = Util::arrayToAttributes($this->atts);
    }
}

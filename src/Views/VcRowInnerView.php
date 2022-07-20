<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Components\VcRowInner;

/**
 * Class VcRowInnerView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $attributes
 * @property string $tab
 * @property string $default_tab
 * @property string $el_id
 * @property string $disable_element
 * @property array $classes
 * @property array $atts
 */
class VcRowInnerView extends TemplateView
{
    protected $name = 'content-row-inner';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/modules/content-row-inner";
    protected $model_tag = VcRowInner::TAG;

    public function __construct(array $atts = [])
    {
        $atts['options'] = $this->getClassModifiers($atts);
        parent::__construct($atts);
        $this->classes[] = 'row';
        if ('yes' === $this->disable_element) {
            $this->classes[] = 'vc-hidden';
        }
        if (!$this->tab) {
            if ($this->el_id) {
                $this->atts['id'] = $this->el_id;
            }
        } else {
            $this->atts['data-toggle-target'] = $this->el_id;
            if ($this->default_tab) {
                $this->atts['data-toggle-default'] = null;
            }
        }

        $this->atts['class'] = $this->formatClass($this->atts);
        $this->attributes = Util::arrayToAttributes($this->atts);
    }

    /**
     * @param array $attributes
     * @return array
     */
    protected function getClassModifiers(array $attributes)
    {
        $class_modifiers = [];
        if (!empty($attributes['width'])) {
            $class_modifiers[] = $attributes['width'];
        }
        $class_modifiers = array_merge($class_modifiers, $attributes['options']);
        return $class_modifiers;
    }
}

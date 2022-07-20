<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Components\VcColumnInner;

/**
 * Class VcColumnInnerView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $attributes
 * @property string $el_id
 * @property string $width
 * @property string $offset
 */
class VcColumnInnerView extends TemplateView
{
    protected $name = 'content-column-inner';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/modules/content-column-inner";
    protected $model_tag = VcColumnInner::TAG;

    public function __construct(array $atts = [])
    {
        $atts['options'] = $this->getClassModifiers($atts);
        parent::__construct($atts);
        if ($this->el_id) {
            $this->atts['id'] = $this->el_id;
        }
        if ($this->width) {
            $this->width = wpb_translateColumnWidthToSpan($this->width);
            if ($this->offset) {
                $this->width = vc_column_offset_class_merge($this->offset, $this->width);
            }
            $this->classes[] = $this->width;
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
        if (!empty($alignment = $attributes['alignment'])) {
            $class_modifiers[] = $alignment;
        }
        $class_modifiers = array_merge($class_modifiers, $attributes['options']);
        return $class_modifiers;
    }
}

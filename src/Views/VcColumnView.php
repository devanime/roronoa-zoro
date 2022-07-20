<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Components\VcColumn;

/**
 * Class VcColumnView
 * @package DevAnime\RoronoaZoro\Views
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string                   $attributes
 * @property string                   $inner_attributes
 * @property string                   $el_id
 * @property string                   $width
 * @property string                   $offset
 * @property array                    $atts
 * @property array                    $classes
 * @property BackgroundImageView|bool $background_image
 */
class VcColumnView extends TemplateView
{
    protected $name = 'content-column';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/modules/content-column";
    protected $model_tag = VcColumn::TAG;

    public function __construct(array $atts = [])
    {
        $this->background_image = BackgroundImageView::createFromContainerAtts($atts);
        $atts['options'] = $this->getClassModifiers($atts) ?: [];
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
        $this->classes = array_filter(array_merge(
            $this->classes ?: [],
            [
                $atts['valignment'] ?? false,
                $atts['halignment'] ?? false,
            ]
        ));
        $this->classes[] = $atts['alignment'];
        $this->atts['class'] = $this->formatClass($this->atts);
        $this->attributes = Util::arrayToAttributes($this->atts);
        $inner_attributes = Util::componentAttributesArray('content-column__inner', $atts['options']);
        unset($inner_attributes['data-gtm']);
        $this->inner_attributes = Util::arrayToAttributes($inner_attributes);
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    protected function getClassModifiers(array $attributes)
    {
        $class_modifiers = array_merge(
            BackgroundImageView::addClassModifiers($this->background_image, $attributes),
            explode(',', $attributes['no_gutter'] ?? ''),
            [
                'last',
                $attributes['fill'] ?? false
            ],

            $attributes['options'] ?: []);

        return array_unique(array_filter($class_modifiers));
    }
}

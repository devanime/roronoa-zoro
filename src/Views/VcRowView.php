<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Components\VcRow;

/**
 * Class VcRowView
 * @package DevAnime\RoronoaZoro\Views
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string                   $el_id
 * @property string                   $tab
 * @property string                   $default_tab
 * @property string                   $disable_element
 * @property BackgroundImageView|bool $background_image
 * @property array                    $classes
 * @property string                   $attributes
 */
class VcRowView extends TemplateView
{
    protected $name = 'content-row';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/modules/content-row";
    protected $model_tag = VcRow::TAG;

    public function __construct(array $atts = [])
    {
        $this->background_image = BackgroundImageView::createFromContainerAtts($atts);
        $atts['options'] = $this->getClassModifiers($atts);
        parent::__construct($atts);
        $this->classes = array_filter(array_merge(
            $this->classes ?: [],
            ['row', $atts['valignment'] ?? false, $atts['halignment'] ?? false]
        ));
        $this->attributes = Util::arrayToAttributes($this->getElementAttributes());
    }

    /**
     * @return array
     */
    protected function getElementAttributes()
    {
        $attributes = [];
        if (! $this->tab) {
            if ($this->el_id) {
                $attributes['id'] = $this->el_id;
            }
        } else {
            $attributes['data-toggle-target'] = $this->el_id;
            if ($this->default_tab) {
                $attributes['data-toggle-default'] = null;
            }
        }
        if ('yes' === $this->disable_element) {
            $this->classes[] = 'vc-hidden';
        }
        $attributes['class'] = $this->formatClass($attributes);
        return $attributes;
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
            [$attributes['bottom_margin'] ?? ''],
            $attributes['options'] ?: []
        );

        return array_unique(array_filter($class_modifiers));
    }
}

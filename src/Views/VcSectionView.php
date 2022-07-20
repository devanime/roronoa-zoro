<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Components\VcSection;

/**
 * Class VcSectionView
 * @package DevAnime\RoronoaZoro\Views
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string                   $el_id
 * @property string                   $tab
 * @property string                   $default_tab
 * @property string                   $disable_element
 * @property string                   $container_class
 * @property string                   $width
 * @property BackgroundImageView|bool $background_image
 * @property array                    $classes
 * @property string                   $background_image_id
 * @property string                   $background_position
 * @property string                   $background_size
 * @property boolean                  $background_repeat
 * @property string                   $attributes
 */
class VcSectionView extends TemplateView
{
    const DEFAULT_WIDTH_CLASS = 'container';
    const FULL_WIDTH_CLASS = 'container-fluid';

    protected $name = 'content-section';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/modules/content-section";
    protected $model_tag = VcSection::TAG;

    public function __construct(array $atts = [])
    {
        $this->background_image = BackgroundImageView::createFromContainerAtts($atts);
        $atts['options'] = $this->getClassModifiers($atts) ?: [];
        parent::__construct($atts);
        $this->container_class = $this->getContainerClass();
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
        if (strpos($this->options, '--has-bg')) {
            $this->classes[] = 'anchor';
        }
        $attributes['class'] = $this->formatClass($attributes);

        return $attributes;
    }

    /**
     * @return string
     */
    protected function getContainerClass()
    {
        if ($this->width === 'width-full') {
            return static::FULL_WIDTH_CLASS;
        }

        return static::DEFAULT_WIDTH_CLASS;
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
            [
                $attributes['width'] ?? '',
                $attributes['height'] ?? '',
                $attributes['column_layout'] ?? '',
                $attributes['bottom_margin'] ?? '',
                $attributes['container_position'] ?? ''
            ],
            $attributes['options'] ?: []);

        return array_unique(array_filter($class_modifiers));
    }
}

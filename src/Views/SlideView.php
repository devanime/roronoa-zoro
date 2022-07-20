<?php
/**
 * Class SlideView
 * @package DevAnime\RoronoaZoro\Views
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Components\Slide;


/**
 * Class VcRowView
 * @package DevAnime\RoronoaZoro\Views
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property BackgroundImageView|bool $background_image
 * @property array                    $classes
 * @property string                   $attributes
 */
class SlideView extends TemplateView
{
    protected $name = 'vc-content-slide';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/modules/content-slide";
    protected $model_tag = Slide::TAG;

    public function __construct(array $atts = [])
    {
        $this->background_image = BackgroundImageView::createFromContainerAtts($atts);
        $atts['options'] = $this->getClassModifiers($atts);
        parent::__construct($atts);
        $this->attributes = Util::arrayToAttributes($this->getElementAttributes());
    }

    /**
     * @return array
     */
    protected function getElementAttributes()
    {
        $attributes = [];
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
            $attributes['options'] ?: []);

        return array_unique(array_filter($class_modifiers));
    }
}

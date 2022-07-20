<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Estarossa\ImageCaption\ImageCaptionView;
use DevAnime\RoronoaZoro\Support\ComponentViewModifiersTrait;

/**
 * Class CarouselView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property array $slides
 * @property string $options
 * @property array $modifiers
 */
class ImageCarouselView extends TemplateView
{
    protected $name = 'carousel';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/carousel";
    use ComponentViewModifiersTrait;

    public function __construct($atts)
    {
        parent::__construct($atts);
        $this->modifiers = $this->getComponentModifiers($this->options);
        if (is_string($this->slides)) {
            $this->slides = explode(',', $this->slides);
        }
        if (is_array($this->slides)) {
            $this->slides = array_map(function ($image_id) {
                return new ImageCaptionView(compact('image_id'));
            }, $this->slides);
        }
    }
}

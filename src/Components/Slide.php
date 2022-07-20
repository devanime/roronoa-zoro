<?php
/**
 * Class Slide
 * @package DevAnime\RoronoaZoro\Components
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Estarossa\ContentSlider\SlideView;
use DevAnime\RoronoaZoro\Support\BackgroundImageTrait;
use DevAnime\RoronoaZoro\Support\ChildContainer;
use DevAnime\RoronoaZoro\Views\SlideView as VcSlideView;

class Slide extends ChildContainer
{

    const NAME = 'Slide';
    const TAG = 'slide';
    protected $parent = 'slider';
    protected $component_config = [
        'description' => 'Slide Container',
        'is_container' => true,
        'content_element' => true,
        'show_settings_on_create' => false,
        'js_view' => 'VcColumnView',
        'icon' => 'icon-slide',
        'class' => 'slide-container',
        'category' => 'Structure',
        'params' => [],
    ];

    use BackgroundImageTrait;

    protected function setupConfig()
    {
        parent::setupConfig();
        $this->component_config['params'] = $this->appendBackgroundImageConfig($this->component_config['params']);
        $this->applyBackgroundColorFilter();
    }

    protected function createView(array $atts)
    {
        $vcView = new VcSlideView($atts);

        return new SlideView(['content' => $vcView]);
    }

}

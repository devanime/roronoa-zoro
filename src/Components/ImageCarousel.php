<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\Component;
use DevAnime\RoronoaZoro\Views\ImageCarouselView;

/**
 * Class ImageCarousel
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ImageCarousel extends Component
{
    const NAME = 'Image Carousel';
    const TAG = 'image_carousel';
    const VIEW = ImageCarouselView::class;

    protected $component_config = [
        'description' => 'Create image-based carousel.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            'images' => [
                'type' => 'attach_images',
                'heading' => 'Images',
                'param_name' => 'slides',
                'value' => '',
                'description' => 'Select multiple images from the media library.',
                'group' => 'Content',
                'admin_label' => true
            ]
        ]
    ];
}

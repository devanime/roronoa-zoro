<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Producers\MediaGallery\MediaGalleryPost;
use DevAnime\Producers\MediaGallery\MediaGalleryRepository;
use DevAnime\Estarossa\MediaCarousel\MediaCarouselView;
use DevAnime\RoronoaZoro\Support\Component;

/**
 * Class MediaCarousel
 * @package Theme\Components\MediaCarousel
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class MediaCarousel extends Component
{
    const NAME = 'Media Carousel';
    const TAG = 'media_carousel';
    const VIEW = MediaCarouselView::class;

    protected $component_config = [
        'description' => 'Select a photo/video gallery to display.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'js_view'  => 'vcAdminPostTitle',
        'params' => [
            'galleries' => [
                'type' => 'dropdown',
                'heading' => 'Media Gallery',
                'param_name' => 'media_gallery_post_id',
                'value' => '',
                'description' => 'Select a media gallery to display.',
                'group' => 'General',
                'admin_label' => true
            ]
        ]
    ];

    protected function populateConfigOptions()
    {
        $this->setGalleries();
    }

    protected function setGalleries()
    {
        $options['-- Select Media Gallery --'] = '';
        $Repository = new MediaGalleryRepository();
        $galleries = $Repository->findAll();
        foreach ($galleries as $Gallery) {
            /* @var MediaGalleryPost $Gallery */
            $options[$Gallery->title()] = $Gallery->ID;
        }
        $this->component_config['params']['galleries']['value'] = $options;
    }

    protected function createView(array $atts)
    {
        if (empty($atts['media_gallery_post_id'])) {
            return '';
        }
        /* @var MediaCarouselView $ViewClass */
        $ViewClass = static::VIEW;
        return $ViewClass::createFromGalleryPost(new MediaGalleryPost($atts['media_gallery_post_id']));
    }
}

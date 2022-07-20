<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Support\ComponentViewModifiersTrait;
use DevAnime\View\Component;

/**
 * Class BackgroundImageView
 * @package DevAnime\RoronoaZoro\Views
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class BackgroundImageView extends Component
{
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/background-image";
    protected $name = 'content-background-image';
    use ComponentViewModifiersTrait;
    use BackgroundContainerViewTrait;


    public function __construct($image, $atts)
    {
        $hasVideo = !empty($atts['bg_use_video']) && !empty($atts['desktop_video']);
        $imageOpacity = intval($atts['bg_image_opacity'] ?? 0);
        $imageOpacity = ($imageOpacity <= 0 || $imageOpacity >= 100 ) ? false : $imageOpacity;
        $params = [
            'image'           => $image,
            'mobile_image'    => ! empty($atts['background_mobile_image_id']) ?
                \WP_Image::get_by_attachment_id($atts['background_mobile_image_id']) :
                false,
            'image_opacity' => $imageOpacity,
            'has_video' => $hasVideo,
            'desktop_video' => $hasVideo ? $atts['desktop_video'] : false,
            'mobile_video' => $hasVideo ? $atts['mobile_video'] : false,
            'video_overlay_percent' => (intval($atts['video_overlay_percent']) ?: 0) / 100,
            'class_modifiers' => array_filter([
                $atts['background_v_position'] ?? '',
                $atts['background_h_position'] ?? '',
                $atts['background_size'] ?? '',
                $atts['background_repeat'] ?? '',
                ! empty($atts['mobile_alternate']) ? 'has-mobile' : '',
                !empty($atts['bg_use_video']) && !empty($atts['desktop_video']) ? 'has-video' : ''
            ])
        ];
        $params['classes'] = Util::componentClasses($this->name, $params['class_modifiers']);
        parent::__construct($params);
    }

    public static function createFromContainerAtts($atts)
    {
        if (! empty($atts['bg_use_placeholder'])) {
            $image = \WP_Image::create_placeholder(
                $atts['placeholder_width'] ?: 640,
                $atts['placeholder_height'] ?: 480,
                $atts['placeholder_category'],
                $atts['placeholder_filters']
            );
        } else {
            $image = ! empty($atts['background_image_id']) ? \WP_Image::get_by_attachment_id($atts['background_image_id']) : false;
        }
        $hasVideo = !empty($atts['bg_use_video']) && !empty($atts['desktop_video']);

        return ($image || $hasVideo) ? new static($image, $atts) : false;
    }

    /**
     * @param BackgroundImageView $bg_image
     * @param array               $atts
     * @param array               $modifiers
     *
     * @return array
     */
    public static function addClassModifiers($bg_image, $atts, $modifiers = [])
    {
        if ($bg_image) {
            $modifiers[] = 'has-bg';
        }
        if (! empty($bg_color = $atts['background_color'])) {
            $modifiers[] = 'has-bg';
            $modifiers[] = $bg_color;
        }
        $modifiers = array_merge($modifiers, BackgroundContainerViewTrait::addBackgroundContainerClasses($atts, $modifiers));
        return array_unique(array_filter(array_merge($modifiers)));
    }
}

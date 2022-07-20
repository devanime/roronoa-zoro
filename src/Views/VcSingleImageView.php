<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Util;
use DevAnime\RoronoaZoro\Components\VcSingleImage;
use DevAnime\RoronoaZoro\Support\ComponentViewImageTrait;
use WP_Image;

/**
 * Class VcSingleImageView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $el_id
 * @property string $source
 * @property string $image
 * @property string $width
 * @property string $height
 * @property string $placeholder_width
 * @property string $placeholder_height
 * @property string $placeholder_category
 * @property string $placeholder_filters
 * @property string $title
 * @property string $alignment
 * @property string $link
 * @property string $caption
 * @property array $responsive_images
 * @property array $attributes
 */
class VcSingleImageView extends TemplateView
{
    protected $name = 'vc-single-image';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/vc-single-image";
    protected $model_tag = VcSingleImage::TAG;
    use ComponentViewImageTrait;

    public function __construct(array $atts = [])
    {
        if ($atts['width']) {
            $this->setWidth($atts['width']);
        }
        if ($atts['height']) {
            $this->setHeight($atts['height']);
        }
        if ($atts['alignment']) {
            $atts['options'] = [$atts['alignment']];
        }
        if ($additional_layout_options = $atts['additional_options']) {
            $atts['options'] = array_merge($atts['options'], explode(',', $additional_layout_options));
        }
        if (!empty($atts['responsive_images'])) {
            $atts['responsive_images'] = array_map([WP_Image::class, 'get_by_attachment_id'], $atts['responsive_images']);
            if ($atts['custom_style']) {
                $atts['responsive_images'] = array_map(function ($img) use ($atts) {
                    return $img->custom_attr('style', $atts['custom_style']);
                }, $atts['responsive_images']);
            }
        }
        parent::__construct($atts);
        if ($this->el_id) {
            $this->atts['id'] = $this->el_id;
        }

        $this->image = $this->getImage();
        if ($atts['custom_style']) {
            $this->image->custom_attr('style', $atts['custom_style']);
        }
        $this->atts['class'] = $this->formatClass($this->atts);
        $this->attributes = Util::arrayToAttributes($this->atts);
    }

    protected function getImage()
    {
        $image = 'featured_image' === $this->source ?
            $this->getImageByPostId(get_post_thumbnail_id()) : $this->getImageById($this->image ?? '');
        if ($this->source === 'placeholder') {
            $image = WP_Image::create_placeholder(
                $this->placeholder_width, $this->placeholder_height,
                $this->placeholder_category, $this->placeholder_filters
            );
        }
        if ($image instanceof \WP_Image) {
            if ($this->title) {
                $image->alt($this->title);
            }
            $this->caption = $image->caption;
            $image->css_class($this->getImageClasses());
        }
        return $image;
    }

    protected function getImageClasses()
    {
        $image_classes = [
            sprintf("%s__image", $this->name)
        ];
        return $image_classes;
    }
}

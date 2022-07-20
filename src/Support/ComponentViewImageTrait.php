<?php

namespace DevAnime\RoronoaZoro\Support;

use WP_Image;

/**
 * Trait ComponentViewImageTrait
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
trait ComponentViewImageTrait
{
    protected static $width = false;
    protected static $height = false;

    public static function setWidth(string $width)
    {
        return static::$width = $width;
    }

    public static function setHeight(string $height)
    {
        return static::$height = $height;
    }

    protected function getImageById(string $image_id)
    {
        $image = WP_Image::get_by_attachment_id($image_id);
        return $image instanceof WP_Image ?
            $this->maybeSetDimensionsOnImage($image) : false;
    }

    protected function getImageByUrl(string $url)
    {
        $image = WP_Image::create_from_url($url);
        return $image instanceof WP_Image ?
            $this->maybeSetDimensionsOnImage($image) : false;
    }

    protected function getImageByPostId(string $post_id)
    {
        $image = WP_Image::get_featured($post_id);
        return $image instanceof WP_Image ?
            $this->maybeSetDimensionsOnImage($image) : false;
    }

    protected function maybeSetDimensionsOnImage(WP_Image $image)
    {
        if (static::$width) {
            $image->width(static::$width);
        }
        if (static::$height) {
            $image->height(static::$height);
        }
        return $image;
    }
}

<?php

use DevAnime\Util;

/**
 * Expected:
 * @var WP_Image $image
 * @var bool     $use_mobile
 * @var WP_Image $mobile_image
 * @var int      $image_opacity
 * @var bool     $has_video
 * @var string   $desktop_video
 * @var string   $mobile_video
 * @var string   $video_overlay_percent
 * @var string   $classes
 */

if (! $image instanceof WP_Image) {
    return false;
}

$image->width(apply_filters('roronoa-zoro/background-image-threshold', 1400))->get_html();

$image_alt = $image->alt && strpos((string)$image->url, (string)$image->alt) === false ? esc_attr($image->alt) : false;
$mobile_url = '';

if ($mobile_image instanceof WP_Image) {
    $mobile_image->width(apply_filters('roronoa-zoro/background-image-threshold-mobile', 640))->get_html();
    $mobile_url = $mobile_image->url;
    $mobile_alt = $mobile_image->alt && strpos((string)$mobile_image->url,
        (string)$mobile_image->alt) === false ? esc_attr($mobile_image->alt) : false;
}

?>
<span class="<?= $classes; ?>"<?= $image_opacity ? ' style="opacity: ' . $image_opacity / 100 . '"' : ''; ?>>
    <span class="content-background-image__images">
    <span class="content-background-image__img content-background-image__img--desktop" data-lazy-bg="<?= $image->url ?>"<?= $image_alt ? " role='img' aria-label='{$image_alt}'" : ''; ?>>
        <?php do_action('roronoa-zoro/inside-background-image', $image, 'desktop'); ?>
    </span>
    <?php if ($mobile_url): ?>
        <span class="content-background-image__img content-background-image__img--mobile" data-lazy-bg="<?= $mobile_url ?>"<?= $mobile_alt ? " role='img' aria-label='{$mobile_alt}'" : ''; ?>>
            <?php do_action('roronoa-zoro/inside-background-image', $mobile_image, 'mobile'); ?>
        </span>
    <?php endif ?>
    </span>
    <?php if ($has_video):
        $videoAttr = [
            'class' => 'content-background-image__videos',
            'data-video-src' => json_encode(['mobile' => $mobile_video, 'desktop' => $desktop_video])
        ];
        ?>
        <div <?= Util::arrayToAttributes($videoAttr) ?>>
            <video class="content-background-image__video <?= $mobile_video ? 'content-background-image__video--desktop' : '' ?>" playsinline autoplay muted loop>
                <source src="" type="video/mp4">
            </video>
            <?php if($mobile_video) : ?>
                <video class="content-background-image__video content-background-image__video--mobile" playsinline autoplay muted loop>
                    <source src="" type="video/mp4">
                </video>
            <?php endif; ?>
            <div class="content-background-image__video__overlay" style="opacity: <?= $video_overlay_percent ?>;"></div>
        </div>
    <?php endif; ?>
</span>

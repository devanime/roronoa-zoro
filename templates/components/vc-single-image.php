<?php
/**
 * Expected:
 * @var string $attributes
 * @var WP_Image $image
 * @var Link $link
 * @var bool $no_lazy
 * @var string $caption
 * @var string $title
 * @var array $responsive_images
 */

use DevAnime\Estarossa\ResponsivePicture\ResponsivePictureView;
use DevAnime\Estarossa\LazyImage\LazyImageView;
use DevAnime\View\Link;

if (!$image instanceof WP_Image) {
    return;
}

$image = !empty($responsive_images) ?
    ResponsivePictureView::createFromBreakpoints(array_merge($responsive_images, ['xs' => $image]), !$no_lazy) :
    ($no_lazy ? $image : LazyImageView::create($image));

if ($link) {
    $link_content = $title ?: $link->getContent();
    if ($link_content) {
        $link = $link->attribute('aria-label', $link_content);
    }
    $image = $link->content($image);
}
?>

<div <?= $attributes; ?>>
    <figure class="vc-single-image__figure">
        <?= $image; ?>
        <?php if ($caption) : ?>
            <figcaption class="vc-single-image__caption"><?= $caption; ?></figcaption>
        <?php endif; ?>
    </figure>
</div>

<?php
/**
 * Expected:
 * @var string $title
 * @var string $content
 * @var WP_Image $image
 * @var array $button
 * @var array $modifiers
 */

use DevAnime\Estarossa\LazyImage\LazyImageView;
use DevAnime\RoronoaZoro\Views\CalloutView;

?>

<div class="callout <?= $modifiers; ?>" data-gtm="callout">
    <?php if ($image instanceof WP_Image) : ?>
        <div class="callout__image">
            <?= LazyImageView::create($image->width(CalloutView::IMAGE_WIDTH)->height(CalloutView::IMAGE_HEIGHT)); ?>
        </div>
    <?php endif; ?>
    <div class="callout__content">
        <?php if ($title) : ?>
            <h4 class="heading-contrast"><?= $title; ?></h4>
        <?php endif; ?>
        <?= $content; ?>
        <?php if (isset($button['title'])) : ?>
            <?=\DevAnime\Util::acfLinkToEl($button) ?>
        <?php endif; ?>
    </div>
</div>

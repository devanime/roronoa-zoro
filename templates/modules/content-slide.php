<?php
/**
 * Expected:
 * @var string $attributes
 * @var string $background_image
 * @var string $content
 */
?>
<div <?= $attributes; ?>>
    <?= $background_image; ?>
    <div class="vc-content-slide__inner">
        <?= $content; ?>
    </div>
</div>

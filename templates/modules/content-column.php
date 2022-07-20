<?php
/**
 * Expected:
 * @var string $attributes
 * @var string $inner_attributes
 * @var string $background_image
 * @var string $content
 */
?>

<div <?= $attributes; ?>>
    <?= $background_image; ?>
    <div <?= $inner_attributes ?>>
    <?= $content; ?>
    </div>
</div>

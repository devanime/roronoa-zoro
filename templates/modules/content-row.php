<?php
/**
 * Expected:
 * @var string $attributes
 * @var string $background_image
 * @var string $content
 * @var array $scope
 */
?>
<div <?= $attributes; ?>>
    <?php do_action('roronoa-zoro/inside-row-top', $scope); ?>
    <?= $background_image; ?>
    <?= $content; ?>
    <?php do_action('roronoa-zoro/inside-row-bottom', $scope); ?>
</div>

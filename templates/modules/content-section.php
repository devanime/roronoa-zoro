<?php
/**
 * Expected:
 * @var string $attributes
 * @var string $container_class
 * @var string $background_image
 * @var string $content
 * @var array $scope
 */

?>
<section <?= $attributes; ?>>
    <?php do_action('roronoa-zoro/inside-section-top', $scope); ?>
    <?= $background_image; ?>
    <div class="<?= $container_class; ?> content-section__container">
        <?= $content; ?>
    </div>
    <?php do_action('roronoa-zoro/inside-section-bottom', $scope); ?>
</section>

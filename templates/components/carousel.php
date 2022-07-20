<?php
/**
 * Expected:
 * @var array $slides
 * @var string $modifiers
 */
?>

<div class="carousel <?= $modifiers; ?>">
    <?php foreach ($slides as $slide) : ?>
        <?= $slide; ?>
    <?php endforeach; ?>
</div>

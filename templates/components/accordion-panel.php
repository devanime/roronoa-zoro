<?php
/**
 * Expected:
 * @var string $heading
 * @var string $content
 * @var string $accordion_style
 */
?>
<div class="accordion__item accordion__item-<?= $accordion_style; ?>">
    <button>
        <span class="accordion__text"><?= $heading; ?></span>
        <span class="accordion__icon"></span>
    </button>
    <div class="accordion__panel">
        <?= $content; ?>
    </div>
</div>

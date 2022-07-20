<?php
/**
 * Expected:
 * @var string $content
 * @var array $modifiers
 */
?>
<div class="sub-nav <?= $modifiers; ?>">
    <ul class="sub-nav__list" role="tablist">
        <?= $content; ?>
    </ul>
</div>

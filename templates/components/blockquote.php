<?php

use DevAnime\Util;
use DevAnime\View\Element;
use DevAnime\View\Link;
use DevAnime\Estarossa\Icon\IconView;

/**
 * Expected:
 * @var Element      $content
 * @var IconView     $icon
 * @var Element|Link $attribution
 * @var Element|Link $cite
 * @var string       $footnote
 * @var array        $class_modifiers
 * @var array        $element_attributes
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */

$source = implode(',&nbsp;', array_filter([(string)$attribution, (string)$cite]));

if (empty($source)) {
    return $content;
}
?>

<figure <?= Util::componentAttributes('blockquote', $class_modifiers, $element_attributes); ?>>
    <?= $content; ?>
    <figcaption class="blockquote__caption">
        <?= $icon; ?><?= $source; ?>
        <?php if ($footnote): ?>
            <footer class="blockquote__footnote"><?= $footnote; ?></footer>
        <?php endif; ?>
    </figcaption>
</figure>

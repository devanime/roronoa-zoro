<?php
/**
 * Expected:
 * @var string $title
 * @var string $url
 * @var string $group_id
 * @var array $element_attributes
 */

use DevAnime\View\Link;

?>

<li class="sub-nav__item" role="presentation">
    <?= new Link($url, $title, array_merge(['class' => 'sub-nav__link', 'data-group' => $group_id], $element_attributes ?? [])); ?>
</li>

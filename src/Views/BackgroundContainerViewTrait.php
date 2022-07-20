<?php

namespace DevAnime\RoronoaZoro\Views;

/**
 * Class BackgroundContainerViewTrait
 * @package DevAnime\RoronoaZoro\Views
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
trait BackgroundContainerViewTrait
{
    /**
     * @param array $modifiers
     * @return array
     */
    public static function addBackgroundContainerClasses($atts, $modifiers)
    {
        if (in_array('has-bg', $modifiers)) {
            $modifiers[] = $atts['top_pad'] ?? '';
            $modifiers[] = $atts['bottom_pad'] ?? '';
        }

        return array_unique(array_filter($modifiers));
    }
}

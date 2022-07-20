<?php

namespace DevAnime\RoronoaZoro\Support;

/**
 * Trait ComponentViewModifiersTrait
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
trait ComponentViewModifiersTrait
{
    /**
     * @param array|string|null $options
     * @param string|null       $base_name
     *
     * @return string
     */
    protected function getComponentModifiers($options, $base_name = null)
    {
        $base_name = $base_name ?: $this->name;
        if (!is_array($options)) {
            $options = explode(',', $options);
        }
        return implode(' ', preg_filter(
            '/^/',
            "{$base_name}--",
            array_filter($options)
        ));
    }
}

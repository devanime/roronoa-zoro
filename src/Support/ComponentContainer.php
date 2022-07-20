<?php

namespace DevAnime\RoronoaZoro\Support;

/**
 * Class ComponentContainer
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ComponentContainer extends \WPBakeryShortCodesContainer implements RegistersComponentConfig
{
    const NAME = null;
    const TAG = null;
    const VIEW = null;

    use ComponentRegistrationTrait, ComponentViewTrait;

    public function __construct($settings = [])
    {
        $settings['base'] = static::TAG;
        parent::__construct($settings);
    }
}

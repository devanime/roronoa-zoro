<?php

namespace DevAnime\RoronoaZoro\Support;

/**
 * Trait BackgroundContainerTrait
 * @package DevAnime\RoronoaZoro\Support
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
trait BackgroundContainerTrait
{

    protected function appendBackgroundContainerConfig($config)
    {
        return array_merge($config, [
            [
                'type' => 'dropdown',
                'heading' => sprintf('%s Top Padding', static::NAME),
                'param_name' => 'top_pad',
                'edit_field_class'=> 'vc_col-xs-6',
                'value' => [
                    'Default' => '',
                    'Double' => 'tpad-double',
                    'Half' => 'tpad-half',
                    'None' => 'tpad-none',
                ],
                'description' => 'Set top/bottom inner padding',
                'group' => 'Background'
            ],
            [
                'type' => 'dropdown',
                'heading' => sprintf('%s Bottom Padding', static::NAME),
                'param_name' => 'bottom_pad',
                'edit_field_class'=> 'vc_col-xs-6',
                'value' => [
                    'Default' => '',
                    'Double' => 'bpad-double',
                    'Half' => 'bpad-half',
                    'None' => 'bpad-none',
                ],
                'description' => 'Set top/bottom inner padding',
                'group' => 'Background'
            ]
        ]);
    }
}

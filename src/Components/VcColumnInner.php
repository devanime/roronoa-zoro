<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\ComponentRegistrationTrait;
use DevAnime\RoronoaZoro\Support\ComponentViewTrait;
use DevAnime\RoronoaZoro\Support\RegistersComponentConfig;
use DevAnime\RoronoaZoro\Support\VcUtil;
use DevAnime\RoronoaZoro\Views\VcColumnInnerView;
use WPBakeryShortCode;

require_once vc_path_dir('SHORTCODES_DIR', 'vc-column-inner.php');

/**
 * Class VcColumnInner
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class VcColumnInner extends \WPBakeryShortCode_VC_Column_Inner implements RegistersComponentConfig
{
    const NAME = 'Inner Column';
    const TAG = 'vc_column_inner';
    const VIEW = VcColumnInnerView::class;

    use ComponentRegistrationTrait {
        setupConfig as setupConfigBase;
    }
    use ComponentViewTrait;

    public function __construct(array $settings = [])
    {
        $settings['base'] = static::TAG;
        WPBakeryShortCode::__construct($settings); //avoids premature script registration in parent
        $this->component_config = [
            'icon' => 'icon-wpb-row',
            'controls' => 'full',
            'allowed_container_element' => false,
            'content_element' => false,
            'is_container' => true,
            'description' => 'Place content elements inside the inner column',
            'js_view' => 'VcColumnView',
            'params' => [
                [
                    'type' => 'el_id',
                    'heading' => 'Element ID',
                    'param_name' => 'el_id',
                    'description' => 'Enter element ID (Note: make sure it is unique and valid according to <a href="http://www.w3schools.com/tags/att_global_id.asp" target="_blank">w3c specification</a>',
                ],
                [
                    'type' => 'textfield',
                    'heading' => 'Extra class name',
                    'param_name' => 'el_class',
                    'value' => '',
                    'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Width',
                    'param_name' => 'width',
                    'value' => [
                        '1 column - 1/12' => '1/12',
                        '2 columns - 1/6' => '1/6',
                        '3 columns - 1/4' => '1/4',
                        '4 columns - 1/3' => '1/3',
                        '5 columns - 5/12' => '5/12',
                        '6 columns - 1/2' => '1/2',
                        '7 columns - 7/12' => '7/12',
                        '8 columns - 2/3' => '2/3',
                        '9 columns - 3/4' => '3/4',
                        '10 columns - 5/6' => '5/6',
                        '11 columns - 11/12' => '11/12',
                        '12 columns - 1/1' => '1/1',
                    ],
                    'group' => 'Responsive Options',
                    'description' => 'Select column width.',
                    'std' => '1/1',
                ],
                [
                    'type' => 'column_offset',
                    'heading' => 'Responsiveness',
                    'param_name' => 'offset',
                    'group' => 'Responsive Options',
                    'description' => 'Adjust column for different screen sizes. Control width, offset and visibility settings.',
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Alignment',
                    'param_name' => 'alignment',
                    'value' => [
                        'Default' => '',
                        'Center' => 'align-center',
                        'Bottom' => 'align-bottom'
                    ],
                    'description' => 'Set the column alignment.',
                    'group' => 'Layout'
                ]
            ]
        ];
        if (VcUtil::isEditFormForBlock()) {
            $this->component_config['params'] = [];
        }
    }

    protected function setupConfig()
    {
        $this->setupConfigBase();
        if ($additional_options = apply_filters('devanime/roronoa-zoro/column-inner/additional-options', [])) {
            $this->component_config['params'][] = [
                'type' => 'checkbox',
                'param_name' => 'options',
                'heading' => 'Additional Options',
                'group' => 'Layout',
                'value' => $additional_options
            ];
        }
    }

    protected function createView(array $atts)
    {
        $atts['options'] = explode(',', $atts['options'] ?? '');
        $ViewClass = static::VIEW;
        return new $ViewClass($atts);
    }
}

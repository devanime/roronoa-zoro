<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\BackgroundContainerTrait;
use DevAnime\RoronoaZoro\Support\BackgroundImageTrait;
use DevAnime\RoronoaZoro\Support\ComponentRegistrationTrait;
use DevAnime\RoronoaZoro\Support\ComponentViewTrait;
use DevAnime\RoronoaZoro\Support\RegistersComponentConfig;
use DevAnime\RoronoaZoro\Support\VcUtil;
use DevAnime\RoronoaZoro\Views\VcRowView;
use WPBakeryShortCode;

require_once vc_path_dir('SHORTCODES_DIR', 'vc-row.php');

/**
 * Class VcRow
 * @package Theme\Components
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class VcRow extends \WPBakeryShortCode_VC_Row implements RegistersComponentConfig
{
    const NAME = 'Row';
    const TAG = 'vc_row';
    const VIEW = VcRowView::class;

    use ComponentRegistrationTrait {
        setupConfig as setupConfigBase;
    }
    use ComponentViewTrait;
    use BackgroundImageTrait;
    use BackgroundContainerTrait;

    public function __construct(array $settings = [])
    {
        $settings['base'] = static::TAG;
        WPBakeryShortCode::__construct($settings); //avoids premature script registration in parent
        $this->component_config = [
            'description' => 'Place content elements inside the row.',
            'icon' => 'icon-wpb-row',
            'wrapper_class' => 'clearfix',
            'is_container' => true,
            'category' => 'Content',
            'show_settings_on_create' => false,
            'class' => 'vc_main-sortable-element',
            'js_view' => 'VcRowView',
            'params' => [
                [
                    'type' => 'el_id',
                    'heading' => 'Row ID',
                    'param_name' => 'el_id',
                    'description' => 'Enter row ID (Note: make sure it is unique and valid according to <a href="http://www.w3schools.com/tags/att_global_id.asp" target="_blank">w3c specification</a>',
                    'group' => 'General'
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Use Row ID as Tab ID',
                    'param_name' => 'tab',
                    'value' => '',
                    'description' => 'Removes default html attribute and anchor behavior',
                    'group' => 'General'
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Default Tab',
                    'param_name' => 'default_tab',
                    'value' => '',
                    'description' => 'Set this row to be the default tab.',
                    'group' => 'General'
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Disable row',
                    'param_name' => 'disable_element',
                    'description' => 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.',
                    'value' => ['Yes' => 'yes'],
                    'group' => 'General'
                ],
                [
                    'type' => 'textfield',
                    'heading' => 'Extra class name',
                    'param_name' => 'el_class',
                    'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
                    'group' => 'General'
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Bottom Margin',
                    'param_name' => 'bottom_margin',
                    'value' => [
                        'Default' => '',
                        'Double' => 'mb-double',
                        'Half' => 'mb-half',
                        'None' => 'mb-none'
                    ],
                    'description' => 'Set the margin space below the row.',
                    'group' => 'Layout'
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Vertical Alignment',
                    'param_name' => 'valignment',
                    'value' => [
                        'Default (Top)' => '',
                        'Center' => 'align-items-center',
                        'Bottom' => 'align-items-end',
                        'Match Content Height' => 'match-content-height'
                    ],
                    'description' => 'Set the column alignment.',
                    'group' => 'Layout'
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Horizontal Column Alignment',
                    'param_name' => 'halignment',
                    'value' => [
                        'Default (Left)' => '',
                        'Center' => 'justify-content-center',
                        'Right' => 'justify-content-end',
                        'Distribute' => 'justify-content-between'
                    ],
                    'description' => 'Set the column alignment.',
                    'group' => 'Layout'
                ]
            ]
        ];
        $this->component_config['params'] = $this->appendBackgroundImageConfig($this->component_config['params']);
        $this->component_config['params'] = $this->appendBackgroundContainerConfig($this->component_config['params']);

        if (VcUtil::isEditFormForBlock()) {
            $this->component_config['params'] = array_filter($this->component_config['params'], function($param) {
                return $param['group'] == 'General';
            });
        }
    }

    protected function setupConfig()
    {
        $this->setupConfigBase();
        $this->applyBackgroundColorFilter();
        if ($additional_options = apply_filters('devanime/roronoa-zoro/row/additional-options', [])) {
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

<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\BackgroundContainerTrait;
use DevAnime\RoronoaZoro\Support\BackgroundImageTrait;
use DevAnime\RoronoaZoro\Support\ComponentRegistrationTrait;
use DevAnime\RoronoaZoro\Support\ComponentViewTrait;
use DevAnime\RoronoaZoro\Support\RegistersComponentConfig;
use DevAnime\RoronoaZoro\Support\VcUtil;
use DevAnime\RoronoaZoro\Views\VcSectionView;
use WPBakeryShortCode;

require_once vc_path_dir('SHORTCODES_DIR', 'vc-section.php');

/**
 * Class VcSection
 * @package Theme\Components
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class VcSection extends \WPBakeryShortCode_VC_Section implements RegistersComponentConfig
{
    const NAME = 'Section';
    const TAG = 'vc_section';
    const VIEW = VcSectionView::class;

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
            'description' => __( 'Group multiple rows in section', 'devanime' ),
            'icon' => 'vc_icon-vc-section',
            'wrapper_class' => 'clearfix',
            'is_container' => true,
            'category' => 'Content',
            'show_settings_on_create' => false,
            'class' => 'vc_main-sortable-element',
            'js_view' => 'VcSectionView',
            'as_parent' => array(
                'only' => 'vc_row',
            ),
            'as_child' => array(
                'only' => '', // Only root
            ),
            'params' => [
                [
                    'type' => 'el_id',
                    'heading' => 'Section ID',
                    'param_name' => 'el_id',
                    'description' => 'Enter section ID (Note: make sure it is unique and valid according to <a href="http://www.w3schools.com/tags/att_global_id.asp" target="_blank">w3c specification</a>',
                    'group' => 'General'
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Use Section ID as Tab ID',
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
                    'description' => 'Set this section to be the default tab.',
                    'group' => 'General'
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Disable section',
                    'param_name' => 'disable_element',
                    'description' => 'If checked the section won\'t be visible on the public side of your website. You can switch it back any time.',
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
                    'heading' => 'Column Layout',
                    'param_name' => 'column_layout',
                    'value' => [
                        'Default (Row)' => '',
                        'Grid' => 'grid',
                        'Tile' => 'tile'
                    ],
                    'description' => 'In a <strong>Row</strong> layout, columns within each row contain related content that should stack evenly (separated by standard component spacing) on mobile, while retaining separation between rows. <br>In a <strong>Grid</strong> layout, each column contains discrete content that should separate evenly when stacked. <br>In a <strong>Tile</strong> layout, there is no space between columns or rows.',
                    'group' => 'Layout'
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Content Width',
                    'param_name' => 'width',
                    'value' => [
                        'Default' => '',
                        'Full' => 'width-full',
                        'Narrow' => 'width-narrow'
                    ],
                    'description' => 'Set the section\'s inner content width.',
                    'group' => 'Layout'
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
                    'description' => 'Set the section bottom spacing.',
                    'group' => 'Layout'
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Height',
                    'param_name' => 'height',
                    'value' => [
                        'Default' => '',
                        'Full' => 'height-full',
                    ],
                    'description' => 'Set the section height.',
                    'group' => 'Layout'
                ]
            ]
        ];
        $this->component_config['params'] = $this->appendBackgroundImageConfig($this->component_config['params']);
        $this->component_config['params'] = $this->appendBackgroundContainerConfig($this->component_config['params']);
        $this->component_config['params'] = $this->appendSectionSpecificBackgroundConfig($this->component_config['params']);

        if (VcUtil::isEditFormForBlock()) {
            $this->component_config['params'] = array_filter($this->component_config['params'], function($param) {
                return $param['group'] == 'General';
            });
        }
    }

    protected function appendSectionSpecificBackgroundConfig($config)
    {
        return array_merge($config, [
            [
                'type' => 'dropdown',
                'param_name' => 'container_position',
                'heading' => 'Background Container Position',
                'description' => 'Set the background container orientation.',
                'group' => 'Background',
                'value' => [
                    'Default' => '',
                    'Left' => 'bg-container-left',
                    'Right' => 'bg-container-right'
                ],
                'edit_field_class'=> 'vc_col-xs-6',
            ]
        ]);
    }

    protected function setupConfig()
    {
        $this->setupConfigBase();
        $this->applyBackgroundColorFilter();
        if ($additional_options = apply_filters('devanime/roronoa-zoro/section/additional-options', [])) {
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

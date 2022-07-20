<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\RoronoaZoro\Support\ComponentRegistrationTrait;
use DevAnime\RoronoaZoro\Support\ComponentViewTrait;
use DevAnime\RoronoaZoro\Support\RegistersComponentConfig;
use DevAnime\RoronoaZoro\Support\VcUtil;
use DevAnime\RoronoaZoro\Views\VcRowInnerView;
use WPBakeryShortCode;

require_once vc_path_dir('SHORTCODES_DIR', 'vc-row-inner.php');

/**
 * Class VcRowInner
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class VcRowInner extends \WPBakeryShortCode_VC_Row_Inner implements RegistersComponentConfig
{
    const NAME = 'Inner Row';
    const TAG = 'vc_row_inner';
    const VIEW = VcRowInnerView::class;

    use ComponentRegistrationTrait {
        setupConfig as setupConfigBase;
    }
    use ComponentViewTrait;

    public function __construct(array $settings = [])
    {
        $settings['base'] = static::TAG;
        WPBakeryShortCode::__construct($settings); //avoids premature script registration in parent
        $this->component_config = [
            'content_element' => false,
            'is_container' => true,
            'icon' => 'icon-wpb-row',
            'weight' => 1000,
            'show_settings_on_create' => false,
            'description' => 'Place content elements inside the inner row',
            'js_view' => 'VcRowView',
            'params' => [
                [
                    'type' => 'el_id',
                    'heading' => 'Row ID',
                    'param_name' => 'el_id',
                    'description' => 'Enter optional row ID (Note: make sure it is unique and valid according to <a href="http://www.w3schools.com/tags/att_global_id.asp" target="_blank">w3c specification</a>'
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Use Row ID as Tab ID',
                    'param_name' => 'tab',
                    'value' => '',
                    'description' => 'Removes default html attribute and anchor behavior'
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Default Tab',
                    'param_name' => 'default_tab',
                    'value' => '',
                    'description' => 'Set this row to be the default tab.'
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Disable row',
                    'param_name' => 'disable_element',
                    'description' => 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.',
                    'value' => ['Yes' => 'yes'],
                ],
                [
                    'type' => 'textfield',
                    'heading' => 'Extra class name',
                    'param_name' => 'el_class',
                    'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
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
        if ($additional_options = apply_filters('devanime/roronoa-zoro/row-inner/additional-options', [])) {
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

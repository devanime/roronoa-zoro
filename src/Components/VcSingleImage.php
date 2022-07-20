<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Estarossa\ResponsivePicture\BreakpointValue as BV;
use DevAnime\RoronoaZoro\Support\ComponentRegistrationTrait;
use DevAnime\RoronoaZoro\Support\ComponentViewTrait;
use DevAnime\RoronoaZoro\Support\RegistersComponentConfig;
use DevAnime\RoronoaZoro\Views\VcSingleImageView;
use DevAnime\View\Link;
use WPBakeryShortCode;

require_once vc_path_dir('SHORTCODES_DIR', 'vc-single-image.php');

class VcSingleImage extends \WPBakeryShortCode_VC_Single_image implements RegistersComponentConfig
{
    const NAME = 'Single Image';
    const TAG = 'vc_single_image';
    const VIEW = VcSingleImageView::class;
    const DEFAULT_WIDTH = '';

    use ComponentRegistrationTrait {
        setupConfig as setupConfigBase;
    }
    use ComponentViewTrait;

    protected $enabled_breakpoints = [];

    public function __construct(array $settings = [])
    {
        $settings['base'] = static::TAG;
        WPBakeryShortCode::__construct($settings); //avoids premature script registration in parent
        $breakpoints = BV::getDefinitions();
        unset($breakpoints[BV::BREAKPOINT_XS]);
        $this->enabled_breakpoints = $breakpoints;
        $this->component_config = [
            'icon' => 'icon-wpb-single-image',
            'category' => 'Content',
            'description' => 'Responsive image',
            'params' => array_merge([
                [
                    'type'        => 'textfield',
                    'param_name'  => 'title',
                    'heading'     => 'Title',
                    'description' => 'Used as the alt text for the image',
                    'admin_label' => true
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Image source',
                    'param_name' => 'source',
                    'value'      => [
                        'Media library'  => 'media_library',
                        'Featured Image' => 'featured_image',
                        'Placeholder' => 'placeholder'
                    ],
                    'std' => 'media_library',
                    'description' => 'Select image source.',
                ],
                [
                    'type'        => 'textfield',
                    'heading'     => 'Placeholder Width',
                    'param_name'  => 'placeholder_width',
                    'edit_field_class'=> 'vc_col-xs-6',
                    'dependency' => [
                        'element' => 'source',
                        'value' => 'placeholder'
                    ],
                ],
                [
                    'type'        => 'textfield',
                    'heading'     => 'Placeholder Height',
                    'param_name'  => 'placeholder_height',
                    'edit_field_class'=> 'vc_col-xs-6',
                    'dependency' => [
                        'element' => 'source',
                        'value' => 'placeholder'
                    ],
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Placeholder Category',
                    'param_name' => 'placeholder_category',
                    'edit_field_class'=> 'vc_col-xs-6',
                    'value' => [
                        'All' => 'any',
                        'Animals' => 'animals',
                        'Architecture' => 'arch',
                        'Nature' => 'nature',
                        'People' => 'people',
                        'Tech' => 'tech'
                    ],
                    'dependency' => [
                        'element' => 'source',
                        'value' => 'placeholder'
                    ]
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Placeholder Filters',
                    'param_name' => 'placeholder_filters',
                    'edit_field_class'=> 'vc_col-xs-6',
                    'value' => [
                        'None' => '',
                        'Grayscale' => 'grayscale',
                        'Sepia' => 'sepia'
                    ],
                    'dependency' => [
                        'element' => 'source',
                        'value' => 'placeholder'
                    ]
                ],
                [
                    'type' => 'attach_image',
                    'heading' => 'Image',
                    'param_name' => 'image',
                    'value' => '',
                    'description' => 'Select image from media library.',
                    'dependency' => [
                        'element' => 'source',
                        'value' => 'media_library',
                    ],
                    'admin_label' => true,
                ],
                [
                    'type' => 'dropdown',
                    'heading' => 'Image alignment',
                    'param_name' => 'alignment',
                    'description' => 'Select image alignment.',
                    'value' => [
                        '-- Select Alignment --' => '',
                        'Left' => 'left',
                        'Right' => 'right',
                        'Center' => 'center',
                    ],
                    'std' => 'center',
                    'group'       => 'Layout',
                ],
                [
                    'type' => 'vc_link',
                    'heading' => 'Image link',
                    'param_name' => 'link',
                    'description' => 'Select URL if you want this image to have a link',
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Lazy Loading',
                    'param_name' => 'no_lazy',
                    'value' => ['Do not lazy load' => true]
                ],
                [
                    'type' => 'el_id',
                    'heading' => 'Element ID',
                    'param_name' => 'el_id',
                    'description' => 'Enter element ID (Note: make sure it is unique and valid according to <a href="http://www.w3schools.com/tags/att_global_id.asp" target="_blank">w3c specification</a>).',
                ],
                [
                    'type' => 'textfield',
                    'heading' => 'Extra class name',
                    'param_name' => 'el_class',
                    'description' => 'Style particular content element differently - add a class name and refer to it in custom CSS.',
                ],
                [
                    'type'        => 'textfield',
                    'heading'     => 'Image Width',
                    'param_name'  => 'width',
                    'group'       => 'Layout',
                    'value'       => apply_filters('devanime/roronoa-zoro/single-image/default-width', self::DEFAULT_WIDTH),
                    'description' => 'Leave blank to auto-size from height',
                ],
                [
                    'type'        => 'textfield',
                    'heading'     => 'Image Height',
                    'param_name'  => 'height',
                    'group'       => 'Layout',
                    'description' => 'Leave blank to auto-size from width',
                ],
                [
                    'type'        => 'textfield',
                    'heading'     => 'Custom Styles',
                    'param_name'  => 'custom_style',
                    'group'       => 'Layout',
                    'description' => 'eg: width: 300px;',
                ],
                [
                    'type' => 'checkbox',
                    'heading' => 'Enabled Breakpoints',
                    'param_name' => 'enabled_breakpoints',
                    'description' => 'Select screen sizes to display an alternative image',
                    'value' => $this->getEnabledBreakpointsValues(),
                    'group' => 'Responsive',
                ]
            ],
                $this->getResponsiveImageParams()
            )
        ];
    }

    protected function setupConfig()
    {
        $this->setupConfigBase();
        if ($additional_options = apply_filters('devanime/roronoa-zoro/image/additional-options', [])) {
            $this->component_config['params'][] = [
                'type' => 'checkbox',
                'param_name' => 'additional_options',
                'heading' => 'Additional Options',
                'group' => 'Layout',
                'value' => $additional_options
            ];
        }
    }

    protected function createView(array $atts)
    {
        $link = vc_build_link($atts['link']);
        $atts['link'] = $link['url'] ? Link::createFromField($link) : null;
        $ViewClass = static::VIEW;
        $responsive_images = [];
        $breakpoints = explode(',', $atts['enabled_breakpoints']);
        foreach ($breakpoints as $breakpoint) {
            $responsive_images[$breakpoint] = $atts["responsive_image_$breakpoint"];
        }
        $atts['responsive_images'] = array_filter($responsive_images);
        return new $ViewClass($atts);
    }

    protected function getResponsiveImageParams()
    {
        $params = [];
        foreach ($this->enabled_breakpoints as $key => $value) {
            $params[] = [
                'type' => 'attach_image',
                'heading' => sprintf('%dpx and larger', $value),
                'param_name' => "responsive_image_$key",
                'edit_field_class' => 'vc_col-sm-6',
                'value' => '',
                'dependency' => [
                    'element' => 'enabled_breakpoints',
                    'value' => [$key],
                ],
                'group' => 'Responsive',
            ];
        }
        return $params;
    }

    protected function getEnabledBreakpointsValues()
    {
        $values = [];
        foreach ($this->enabled_breakpoints as $key => $value) {
            $values[sprintf('%dpx (%s)', $value, $key)] = $key;
        }
        return $values;
    }
}

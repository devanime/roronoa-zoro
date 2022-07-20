<?php

namespace DevAnime\RoronoaZoro\Core;

use DevAnime\RoronoaZoro\Support\VcUtil;

/**
 * Class ParameterReset
 * @package DevAnime\RoronoaZoro\Core
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ParameterReset
{
    private $row_components = [
        'vc_row',
        'vc_row_inner'
    ];
    private $tta_components = [
        'vc_tta_tabs',
        'vc_tta_accordion'
    ];
    private $row_blacklist = [
        'full_width',
        'gap',
        'full_height',
        'columns_placement',
        'equal_height',
        'content_placement',
        'video_bg',
        'video_bg_url',
        'video_bg_parallax',
        'parallax',
        'parallax_image',
        'parallax_speed_video',
        'parallax_speed_bg',
        'css_animation',
        'css'
    ];
    private $tta_blacklist = [
        'style',
        'shape',
        'color',
        'no_fill_content_area',
        'no_fill',
        'spacing',
        'gap',
        'tab_position',
        'alignment',
        'autoplay',
        'active_section',
        'pagination_style',
        'pagination_color',
        'c_align',
        'collapsible_all',
        'c_icon',
        'c_position',
    ];

    public function __construct()
    {
        add_action('init', function () {
            add_action('vc_after_init', function () {
                $this->removeParam($this->row_components, $this->row_blacklist, 'vc_row_params_blacklist');
                $this->removeParam($this->tta_components, $this->tta_blacklist, 'vc_tta_params_blacklist');
            });
        });
    }

    protected function removeParam(array $components, array $blacklist, string $filter = '')
    {
        $blacklist = VcUtil::filterArray($blacklist, $filter);
        foreach ($blacklist as $param) {
            foreach ($components as $component) {
                vc_remove_param($component, $param);
            }
        }
    }
}

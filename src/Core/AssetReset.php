<?php

namespace DevAnime\RoronoaZoro\Core;

use DevAnime\RoronoaZoro\Support\VcUtil;

/**
 * Class AssetReset
 * @package DevAnime\RoronoaZoro\Core
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class AssetReset
{
    private $style_blacklist = [
        'flexslider',
        'nivo-slider-css',
        'nivo-slider-theme',
        'prettyphoto',
        'isotope-css',
        'font-awesome',
        'js_composer_front'
    ];
    private $script_blacklist = [
        'tweet',
        'jcarousellite',
        'prettyphoto',
        'waypoints',
        'jquery_ui_tabs_rotate',
        'isotope',
        'twbs-pagination',
        'nivo-slider',
        'flexslider',
        'vc_accordion_script',
        'vc_tabs_script',
        'vc_tta_autoplay_script',
        'wpb_composer_front_js'
    ];

    public function __construct()
    {
        add_action('init', function () {
            vc_disable_frontend();
            add_action('template_redirect', [$this, 'deregisterAssets'], 20);
            add_action('vc_after_init_base', [$this, 'cleanFrontEnd']);
        });
    }

    public function deregisterAssets()
    {
        $styles = VcUtil::filterArray($this->style_blacklist, 'style_blacklist');
        $scripts = VcUtil::filterArray($this->script_blacklist, 'script_blacklist');
        foreach ($styles as $style) {
            wp_deregister_style($style);
        }
        foreach ($scripts as $script) {
            wp_deregister_script($script);
        }
    }

    public function cleanFrontEnd()
    {
        global $vc_manager;
        remove_action('body_class', [$vc_manager->vc(), 'bodyClass']);
        remove_action('wp_head', [$vc_manager->vc(), 'addNoScript'], 1000);
        remove_action('wp_head', [$vc_manager->vc(), 'addMetaData']);
        remove_action('wp_head', [$vc_manager->vc(), 'addIEMinimalSupport']);
    }
}

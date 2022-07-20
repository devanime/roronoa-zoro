<?php

namespace DevAnime\RoronoaZoro\Support;

/**
 * Class ComponentRegistry
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ComponentBlacklist
{
    private $blacklist = [
        'vc_message',
        'vc_twitter',
        'vc_separator',
        'vc_text_separator',
        'vc_facebook',
        'vc_tweetmeme',
        'vc_googleplus',
        'vc_pinterest',
        'vc_toggle',
        'vc_gallery',
        'vc_tabs',
        'vc_tour',
        'vc_tab',
        'vc_accordion',
        'vc_accordion_tab',
        'vc_posts_grid',
        'vc_carousel',
        'vc_posts_slider',
        'vc_widget_sidebar',
        'vc_button',
        'vc_button2',
        'vc_cta_button',
        'vc_cta_button2',
        'vc_video',
        'vc_gmaps',
        'vc_raw_html',
        'vc_raw_js',
        'vc_flickr',
        'vc_progress_bar',
        'vc_pie',
        'vc_round_chart',
        'vc_line_chart',
        'vc_wp_search',
        'vc_wp_meta',
        'vc_wp_recentcomments',
        'vc_wp_calendar',
        'vc_wp_pages',
        'vc_wp_tagcloud',
        'vc_wp_custommenu',
        'vc_wp_text',
        'vc_wp_posts',
        'vc_wp_links',
        'vc_wp_categories',
        'vc_wp_archives',
        'vc_wp_rss',
        'vc_empty_space',
        'vc_custom_heading',
        'vc_basic_grid',
        'vc_media_grid',
        'vc_masonry_grid',
        'vc_masonry_media_grid',
        'vc_grid_old',
        'vc_cta',
        'vc_tta_tabs',
        'vc_tta_tour',
        'vc_tta_accordion',
        'vc_tta_pageable',
        'vc_btn',
        'vc_icon',
        'vc_acf',
        'vc_zigzag',
        'vc_hoverbox',
        'vc_gutenberg',
        'vc_images_carousel'
    ];

    public function __construct()
    {
        $components = VcUtil::filterArray($this->blacklist, 'blacklist');
        foreach($components as $component) {
            vc_remove_element($component);
        }
    }
}

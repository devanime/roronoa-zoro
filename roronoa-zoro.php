<?php
/*
Plugin Name: Roronoa Zoro
Description: A custom build over Visual Composer, this is the page-builder CMS experience.
Version: 9999
License: GPL-2.0+
*/

use DevAnime\RoronoaZoro\Support\ComponentRegistry;
use \DevAnime\RoronoaZoro\Support\ComponentBlacklist;
use DevAnime\RoronoaZoro\Core\AssetReset;
use DevAnime\RoronoaZoro\Core\ParameterReset;
use DevAnime\RoronoaZoro\Core\BootstrapReset;
use DevAnime\Config;

define('RORONOA_ZORO_PLUGIN_VER', '0.1');
define('RORONOA_ZORO_PLUGIN_FILE', __FILE__);
define('RORONOA_ZORO_PLUGIN_DIR', __DIR__);
define('RORONOA_ZORO_PLUGIN_TEMPLATE_DIR', RORONOA_ZORO_PLUGIN_DIR . '/templates');

if (!defined('USE_COMPOSER_AUTOLOADER') || !USE_COMPOSER_AUTOLOADER) {
    require __DIR__ . '/vendor/autoload.php';
}

add_action('devanime/init', function () {
    if (!function_exists('vc_map')) {
        return false;
    }
    add_action('vc_before_init', function () {
        vc_set_as_theme();
        new ComponentBlacklist();
    });
    new ComponentRegistry();
    new AssetReset();
    new BootstrapReset();
    new ParameterReset();
    new Config(['config_files' => RORONOA_ZORO_PLUGIN_DIR . '/config/block.json']);
    add_action('admin_enqueue_scripts', function () {
        wp_enqueue_script('roronoa-zoro/admin', plugin_dir_url( __FILE__ ) . 'assets/admin.js', [], RORONOA_ZORO_PLUGIN_VER, true);
        wp_enqueue_style('roronoa-zoro', plugin_dir_url( __FILE__ ) . 'assets/dist/admin.css', [], RORONOA_ZORO_PLUGIN_VER);
    });
    add_action( 'wp_ajax_vc_post_id_to_title', function(){
        if ( ! isset( $_POST['post_id'] ) ) {
            wp_send_json_error( 'No Post ID selected' );
        }
        $article = get_post($_POST['post_id']);
        if ( empty( $article ) ) {
            wp_send_json_error( 'Invalid post ID' );
        }
        wp_send_json_success(  apply_filters('roronoa-zoro/admin-post-title', '<a title="Edit Post" href="' . get_edit_post_link( $article->ID ) . '" target="_blank">' . $article->post_title . '</a>', $article) );
    });
    add_action('vc_edit_form_fields_after_render', function () {
        echo '<script>window.vcLibraryOnEditPanelShown && vcLibraryOnEditPanelShown();</script>';
    }, 99);
    return 0;
});

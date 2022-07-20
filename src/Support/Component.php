<?php

namespace DevAnime\RoronoaZoro\Support;

/**
 * Class Component
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class Component extends \WPBakeryShortCode implements RegistersComponentConfig
{
    const NAME = null;
    const TAG = null;
    const VIEW = null;

    use ComponentRegistrationTrait, ComponentViewTrait;

    protected $image_param;

    public function __construct($settings = [])
    {
        $settings['base'] = static::TAG;
        parent::__construct($settings);
        add_filter('roronoa-zoro/admin-post-title', [$this, 'adminPostTitleView'], 5, 2);
    }

    public function singleParamHtmlHolder($param, $value)
    {
        if (!$this->hasImageParam()) {
            return parent::singleParamHtmlHolder($param, $value);
        }
        $output = '';
        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
        $type = isset($param['type']) ? $param['type'] : '';
        $class = isset($param['class']) ? $param['class'] : '';

        if ('attach_image' === $param['type'] && $param_name === 'image') {
            $output .= '<input type="hidden" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" />';
            $element_icon = $this->settings('icon');
            $img = wpb_getImageBySize(array(
                'attach_id' => (int)preg_replace('/[^\d]/', '', $value),
                'thumb_size' => 'thumbnail',
            ));
            $this->setSettings('logo', ($img ? $img['thumbnail'] :
                    '<img width="150" height="150" src="' . vc_asset_url('vc/blank.gif') .
                    '" class="attachment-thumbnail vc_general vc_element-icon icon-wpb-single-image"  data-name="' . $param_name .
                    '" alt="" title="" style="display: none;" />') . '<span class="no_image_image vc_element-icon' .
                (!empty($element_icon) ? ' ' . $element_icon : '') .
                ($img && !empty($img['p_img_large'][0]) ? ' image-exists' : '') .
                '" /><a href="#" class="column_edit_trigger' .
                ($img && !empty($img['p_img_large'][0]) ? ' image-exists' : '') . '">' .
                __('Add image', 'devanime') . '</a>');
            $output .= '<h4 class="wpb_element_title">' . $this->settings['name'] . ' ' . $this->settings('logo') . '</h4>';
        } else {
            return parent::singleParamHtmlHolder($param, $value);
        }

        if (!empty($param['admin_label']) && true === $param['admin_label']) {
            $output .= '<span class="vc_admin_label admin_label_' . $param['param_name'] .
                (empty($value) ? ' hidden-label' : '') .
                '"><label>' . $param['heading'] . '</label>: ' . $value . '</span>';
        }
        return $output;
    }

    protected function outputTitle($title)
    {
        return $this->hasImageParam() ? '' : parent::outputTitle($title);
    }

    protected function hasImageParam()
    {
        $image_params = array_filter($this->component_config['params'], function ($p) {
            return isset($p['type']) && $p['type'] == 'attach_image' && $p['param_name'] == 'image';
        });
        return !empty($image_params);
    }

    /**
     * @param string $content
     * @param \WP_Post $postObj
     *
     * @return string
     */
    public function adminPostTitleView($content, $postObj)
    {
        return $content;
    }
}

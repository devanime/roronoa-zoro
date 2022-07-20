<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Estarossa\SubNav\SubNavView;
use DevAnime\RoronoaZoro\Support\Component;

/**
 * Class SubNav
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class SubNav extends Component
{
    const NAME = 'Sub Navigation';
    const TAG = 'sub-navigation';

    protected $component_config = [
        'description' => 'Set up tabs via sub navigation.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'params' => [
            'placeholder' => [
                'type' => 'textfield',
                'heading' => 'Set placeholder',
                'param_name' => 'placeholder',
                'value' => '',
                'description' => 'Set the dropdown placeholder',
                'group' => 'General'
            ],
            'menus' => [
                'type' => 'dropdown',
                'heading' => 'Menu',
                'param_name' => 'menu',
                'value' => '',
                'description' => '',
                'group' => 'General',
                'admin_label' => true
            ],
            'options' => [
                'type' => 'checkbox',
                'heading' => 'Options',
                'param_name' => 'options',
                'group' => 'Options',
                'value' => [
                    'Wide' => 'wide',
                    'Horizontal' => 'horizontal',
                    'Dropdown' => 'dropdown'
                ],
                'description' => 'Component Options',
            ]
        ]
    ];

    protected function populateConfigOptions()
    {
        $this->setMenus();
    }

    protected function setMenus()
    {
        $options['-- Select a Menu --'] = '';
        $menus = get_terms('nav_menu', ['hide_empty' => true]);
        foreach ($menus as $menu) {
            $options[$menu->name] = $menu->slug;
        }
        $this->component_config['params']['menus']['value'] = $options;
    }

    protected function loadTemplate($atts, $content = null)
    {
        $atts = vc_map_get_attributes($this->getShortcode(), $atts);
        return (SubNavView::createFromMenu($atts['menu'], (array) $atts['options']))->placeholder($atts['placeholder']);
    }
}

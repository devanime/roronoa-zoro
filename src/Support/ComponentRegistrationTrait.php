<?php

namespace DevAnime\RoronoaZoro\Support;

/**
 * Trait ComponentRegistrationTrait
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
trait ComponentRegistrationTrait
{
    protected $component_config = [];

    protected $init_priority = 10;

    protected function populateConfigOptions(){}
    protected function setupConfig()
    {
        if (defined('static::NAME')) {
            $this->component_config['name'] = static::NAME;
        }
        if (defined('static::TAG')) {
            $this->component_config['base'] = static::TAG;
        }
        $this->component_config['php_class_name'] = get_class($this);
    }

    public function register()
    {
        add_action('vc_before_init', function () {
            $this->setupConfig();
            if (is_admin() && wp_doing_ajax() && filter_input(INPUT_POST, 'tag') === static::TAG) {
                $this->populateConfigOptions();
            }
            vc_map($this->component_config);
        }, $this->init_priority);
    }
}

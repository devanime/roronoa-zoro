<?php

namespace DevAnime\RoronoaZoro\Support;

/**
 * Class ChildComponent
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class ChildComponent extends Component
{
    protected $parent;
    protected static $serialize = true;

    protected function setupConfig()
    {
        parent::setupConfig();
        $this->component_config['as_child'] = ['only' => $this->parent];
        add_filter('devanime/roronoa-zoro/children/' . $this->parent, function($children) {
            $children[] = static::TAG;
            return $children;
        });
    }
}

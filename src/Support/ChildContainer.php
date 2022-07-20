<?php
/**
 * Class ChildContainer
 * @package DevAnime\RoronoaZoro\Support
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */

namespace DevAnime\RoronoaZoro\Support;

class ChildContainer extends ComponentContainer
{
    protected $parent;
    protected static $serialize = true;

    protected function setupConfig()
    {
        parent::setupConfig();
        $this->component_config['as_child'] = ['only' => $this->parent];
    }
}

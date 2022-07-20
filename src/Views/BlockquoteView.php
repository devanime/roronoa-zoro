<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\Estarossa\Icon\IconView;
use DevAnime\View\Component;
use DevAnime\View\Element;
use DevAnime\View\Link;

/**
 * Class BlockquoteView
 * @package DevAnime\RoronoaZoro\Views
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $content
 * @property string $size
 * @property IconView $icon
 * @property Element|Link $attribution
 * @property Element|Link $cite
 * @property string $footnote
 */
class BlockquoteView extends Component
{
    protected $name = 'blockquote';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/blockquote";

    protected static $default_properties = [
        'content' => '',
        'size' => '',
        'icon' => '',
        'attribution' => '',
        'cite' => '',
        'footnote' => ''
    ];

    public function __construct($atts = [])
    {
        parent::__construct($atts);
        if(!empty($this->icon)) {
            $this->class_modifiers = ['has-icon'];
        }
        if ($this->content) {
            $blockquote = Element::create('blockquote', $this->content)->addClass('blockquote__quote');
            if ($this->size) {
                $blockquote = $blockquote->addClass('heading--' . $this->size);
            }
            $this->content = $blockquote;
        }
        $this->attribution = $this->attribution->getContent() ? $this->attribution->addClass('blockquote__attribution') : '';
        $this->cite = $this->cite->getContent() ? Element::create('cite', $this->cite)->addClass('blockquote__cite') : '';
    }
}

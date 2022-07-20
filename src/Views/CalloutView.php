<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\RoronoaZoro\Support\ComponentViewImageTrait;
use DevAnime\RoronoaZoro\Support\ComponentViewModifiersTrait;

/**
 * Class CalloutView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $title
 * @property string $content
 * @property \WP_Image $image
 * @property string $image_id
 * @property string $button_title
 * @property string $button_url
 * @property string $button_target
 * @property string $button_event_tracking
 * @property array $button
 * @property string $options
 * @property array $modifiers
 */
class CalloutView extends TemplateView
{
    protected $name = 'callout';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/callout";
    use ComponentViewImageTrait, ComponentViewModifiersTrait;

    public function __construct($atts)
    {
        parent::__construct($atts);
        if ($this->image_id) {
            $this->image = $this->getImageById($this->image_id);
        }
        $this->button = $this->getButton();
        $this->modifiers = $this->getComponentModifiers($this->options);
    }

    /* Helpers */

    protected function getButton(): array
    {
        return [
            'class' => 'btn btn-default',
            'title' => $this->button_title,
            'url' => $this->button_url,
            'target' => $this->button_target = $this->button_target ? '_blank' : '',
            'data-ga-event' => $this->button_event_tracking
        ];
    }
}

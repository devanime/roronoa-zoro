<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\RoronoaZoro\Support\ComponentViewModifiersTrait;

/**
 * Class TabsView
 * @package Theme\Views
 * @author  DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property array  $modifiers
 * @property string $options
 * @property string $format
 * @property string $style
 * @property string $layout
 */
class TabsView extends TemplateView
{
    protected $name = 'tabs';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/tabs";
    use ComponentViewModifiersTrait;

    public function __construct($atts)
    {
        $group_id = hash('crc32', serialize($atts));
        foreach ((array)$atts['content'] as $tab) {
            if ($tab instanceof TabView) {
                $tab->group_id = $group_id;
            }
        }
        $atts['content'] = implode(' ', (array)$atts['content']);
        parent::__construct(array_merge(['group_id' => $group_id], $atts));

        $this->modifiers = $this->getComponentModifiers(
            [$this->options, $this->format, $this->style, $this->layout], 'sub-nav'
        );
    }

    public static function createTabs(array $tabs, string $format = '', string $style = '', string $layout = '')
    {
        return new static([
            'content' => array_map(function ($tab) {
                return new TabView($tab);
            }, $tabs),
            'format' => $format,
            'style' => $style,
            'layout' => $layout
        ]);
    }
}

<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\RoronoaZoro\Support\ComponentViewModifiersTrait;

/**
 * Class ContentHeaderView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $options
 * @property string $modifiers
 */
class ContentHeaderView extends TemplateView
{
    protected $name = 'content-header';
    protected $default_template = RORONOA_ZORO_PLUGIN_TEMPLATE_DIR . "/components/content-header";
    use ComponentViewModifiersTrait;

    public function __construct($atts)
    {
        parent::__construct($atts);
        $this->modifiers = $this->getComponentModifiers($this->options);
    }

    public static function createHeadingWithTabs(string $heading, $tabs, string $options = ''): ContentHeaderView
    {
        if (is_array($tabs)) {
            $tabs = TabsView::createTabs($tabs);
        }
        return new static([
            'content' => implode(' ', [
                new ContentHeaderHeadlineView(compact('heading')),
                $tabs
            ]),
            'options' => $options
        ]);
    }

    public static function createHeading(string $heading, string $options = ''): ContentHeaderView
    {
        return new static([
            'content' => implode(' ', [
                new ContentHeaderHeadlineView(compact('heading'))
            ]),
            'options' => $options
        ]);
    }

    public static function createHeadingWithLink(string $heading, array $link, string $options = ''): ContentHeaderView
    {
        return new static([
            'content' => implode(' ', [
                new ContentHeaderHeadlineView(compact('heading')),
                new ContentHeaderLinkView($link)
            ]),
            'options' => $options
        ]);
    }

    public static function createTabs($tabs, string $options = ''): ContentHeaderView
    {
        if (is_array($tabs)) {
            $tabs = TabsView::createTabs($tabs);
        }
        return new static([
            'content' => (string)$tabs,
            'options' => $options
        ]);
    }
}

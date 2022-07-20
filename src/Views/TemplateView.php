<?php

namespace DevAnime\RoronoaZoro\Views;

use DevAnime\RoronoaZoro\Support\ComponentViewModifiersTrait;
use DevAnime\View\TemplateView as TemplateViewBase;

/**
 * Class TemplateView
 * @package DevAnime\RoronoaZoro\Views
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 * @property string $el_class
 * @property string $options
 */
abstract class TemplateView extends TemplateViewBase
{
    protected $classes = [];
    protected $model_tag = '';
    protected $atts = [];
    use ComponentViewModifiersTrait;

    public function __construct(array $atts = [])
    {
        parent::__construct($atts);
        $this->options = $this->getComponentModifiers($this->options);
        $this->classes[] = $this->name;
        if ($this->el_class) {
            $this->classes[] = str_replace('.', '', $this->el_class);
        }
    }

    protected function formatClass(array $attributes)
    {
        $classes = preg_replace('/\s+/', ' ', apply_filters(
            VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,
            implode(' ',
                array_filter(array_merge(
                    $this->classes,
                    explode(',', $this->options)))
            ),
            $this->model_tag,
            $attributes
        ));
        return apply_filters('roronoa-zoro/template-classes/' . $this->name, $classes, $this->getScope());
    }
}

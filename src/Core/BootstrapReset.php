<?php

namespace DevAnime\RoronoaZoro\Core;

/**
 * Class BootstrapReset
 * @package DevAnime\RoronoaZoro\Core
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class BootstrapReset
{
    private $bootstrap3 = false;

    const V3_BREAKPOINTS = ['-lg', '-md', '-sm', '-xs'];
    const V4_BREAKPOINTS = ['-xl', '-lg', '-md', ''];

    public function __construct()
    {
        add_action('init', function () {
            add_filter('vc_shortcodes_css_class', [$this, 'filterClasses'], 10, 2);
            if (get_theme_support('roronoa-zoro-bootstrap3')) {
                $this->bootstrap3 = true;
            }
        });
        add_filter('body_class', [$this, 'versionBodyClass']);
    }

    public function filterClasses($class_string, string $tag)
    {
        if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
            $class_string = preg_replace('/vc_(col|hidden-[xsmdlg]{2})/', '$1', $class_string);
            $class_string = str_replace('/', '_', $class_string);
            if (!$this->bootstrap3) {
                $class_string = preg_replace_callback('/col(-[xsmdlg]{2})-(\d{1,2})/', $this->replaceV3ColumnClass('col%s-%d'), $class_string);
                $class_string = preg_replace_callback('/hidden(-[xsmdlg]{2})/', $this->replaceV3DisplayClass(), $class_string);
                $class_string = preg_replace_callback('/col(-[xsmdlg]{2})-offset-/', $this->replaceV3ColumnClass('offset%s-'), $class_string);
            }
        }
        $class_string = implode(' ', array_unique(explode(' ', $class_string)));
        return $class_string;
    }

    public function replaceV3DisplayClass()
    {
        return function(array $matches) {
            static $already_hidden = [];
            $hidden = $this->replaceV3Breakpoint($matches[1]);
            array_push($already_hidden, $hidden);
            $classes = sprintf('d%s-none', $hidden);
            $index = array_search($hidden, static::V4_BREAKPOINTS);
            $next_visible = $index ? static::V4_BREAKPOINTS[$index - 1] : false;
            if ($next_visible && !in_array($next_visible, $already_hidden)) {
                $classes .= sprintf(' d%s-flex', $next_visible);
            }
            return $classes;
        };
    }

    protected function replaceV3ColumnClass($format)
    {
        return function(array $matches) use ($format) {
            $matches[1] = $this->replaceV3Breakpoint($matches[1]);
            array_shift($matches);
            $match = vsprintf($format, $matches);
            return $match;
        };
    }

    protected function replaceV3Breakpoint($breakpoint)
    {
        return str_replace(static::V3_BREAKPOINTS, static::V4_BREAKPOINTS, $breakpoint);
    }

    public function versionBodyClass($classes)
    {
        if ($this->bootstrap3) {
            $classes[] = 'vc-bootstrap-3';
        }
        return $classes;
    }
}

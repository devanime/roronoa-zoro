<?php

namespace DevAnime\RoronoaZoro\Support;

class BlockComponent extends ChildComponent
{
    protected function setupConfig()
    {
        parent::setupConfig();
        $this->setBlockPostsParam();
    }

    protected function populateConfigOptions()
    {
        $options = ['-- Select Block --' => ''];
        foreach (get_posts(['post_type' => 'block', 'posts_per_page' => -1]) as $post) {
            $options[get_the_title($post)] = $post->ID;
        }
        $this->component_config['params']['block_post']['value'] = $options;
    }

    protected function setBlockPostsParam()
    {
        $this->component_config['params']['block_post'] = [
            'type' => 'dropdown',
            'heading' => 'Block',
            'param_name' => 'block_id',
            'description' => 'Select Block.',
            'group' => 'Block',
            'admin_label' => true,
            'value' => []
        ];
    }

    protected function content($atts, $content = null)
    {
        if (is_numeric($atts['block_id'])) {
            $block = get_post($atts['block_id']);
            $block_content = preg_replace('@\[vc_row_inner\]\[vc_column_inner\](.*?)\[/vc_column_inner\]\[/vc_row_inner\]@', '$1', $block->post_content);
            $block_content = preg_replace('@\[(/?vc_row)@', '[$1_inner', $block_content);
            $block_content = preg_replace('@\[(/?vc_column)@', '[$1_inner', $block_content);
            $block_content = str_replace('vc_column_inner_text', 'vc_column_text', $block_content);
            $content = do_shortcode($block_content);
        }
        return parent::content($atts, $content);
    }
}

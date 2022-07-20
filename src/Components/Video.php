<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Producers\Video\VideoPost;
use DevAnime\Producers\Video\VideoRepository;
use DevAnime\Estarossa\Modal\ModalView;
use DevAnime\Estarossa\Video\VideoThumb;
use DevAnime\RoronoaZoro\Support\Component;

/**
 * Class Video
 * @package DevAnime\RoronoaZoro\Components
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class Video extends Component
{
    const NAME = 'Video';
    const TAG = 'sit_video';
    const DEFAULT_MODAL_ID = 'video-modal';

    protected $component_config = [
        'description' => 'Video Component',
        'icon' => 'icon-wpb-film-youtube',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'js_view'  => 'vcAdminPostTitle',
        'params' => [
            'videos' => [
                'type' => 'dropdown',
                'heading' => 'Video',
                'param_name' => 'video_id',
                'description' => 'Select a video post.',
                'admin_label' => true
            ],
            'options' => [
                'type' => 'checkbox',
                'heading' => 'Display In Modal?',
                'param_name' => 'display_modal',
                'description' => 'By default the video will play inline. Check this to play in a modal.'
            ],
            'id' => [
                'type' => 'textfield',
                'heading' => 'Target Modal ID',
                'param_name' => 'modal_id',
                'description' => 'Set the id of the modal. Required if more than one video modal is on page. Default: video-modal',
                'dependency' => [
                    'element' => 'display_modal',
                    'not_empty' => true
                ]
            ],
            'modal_content' => [
                'type' => 'checkbox',
                'heading' => 'Modal Content',
                'param_name' => 'modal_content',
                'description' => 'Toggle additional content to appear in the modal.',
                'value' => [
                    'Show Title' => 'title',
                    'Show Description' => 'description',
                ],
                'dependency' => [
                    'element' => 'display_modal',
                    'not_empty' => true
                ]
            ],
        ]
    ];

    protected function populateConfigOptions()
    {
        $this->setVideos();
    }

    protected function setVideos()
    {
        $options['-- Select Video --'] = '';
        $Repository = new VideoRepository();
        $videos = $Repository->findAll();
        foreach($videos as $Video) { /* @var VideoPost $Video */
            $options[$Video->title()] = $Video->ID;
        }
        $this->component_config['params']['videos']['value'] = $options;
    }

    protected function loadTemplate($atts, $content = null)
    {
        $atts = vc_map_get_attributes(static::TAG, $atts);
        $modal_id = $atts['modal_id'] ?: static::DEFAULT_MODAL_ID;
        $options = ! empty($atts['modal_content']) ? explode(',', $atts['modal_content']) : [];
        $options = array_fill_keys($options, true);
        if (!$atts['display_modal']) {
            return VideoThumb::createFromVideoPost(new VideoPost($atts['video_id']));
        }
        ModalView::load($modal_id, apply_filters('devanime/roronoa-zoro/video-modal/type', 'video'));

        return VideoThumb::createFromVideoPost(
            new VideoPost($atts['video_id']),
            '#' . $modal_id,
            false,
            $options
        );
    }
    public function adminPostTitleView($content, $postObj)
    {
        if($postObj->post_type === VideoPost::POST_TYPE) {
            return '[' . $postObj->ID . '] ' . $content;
        }
        return $content;
    }
}

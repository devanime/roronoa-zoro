<?php

namespace DevAnime\RoronoaZoro\Components;

use DevAnime\Estarossa\Talent\TalentCardWrapperView;
use DevAnime\Producers\Talent\TalentPost;
use DevAnime\Producers\Talent\TalentRepository;
use DevAnime\Estarossa\Modal\ModalView;
use DevAnime\RoronoaZoro\Support\Component;

/**
 * Class TalentCard
 * @package DevAnime\RoronoaZoro\Components;
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class TalentCard extends Component
{
    const NAME = 'Talent Card';
    const TAG = 'talent_card';
    const VIEW = TalentCardWrapperView::class;

    protected $component_config = [
        'description' => 'Display talent information.',
        'icon' => 'icon-wpb-toggle-small-expand',
        'wrapper_class' => 'clearfix',
        'is_container' => false,
        'category' => 'Content',
        'js_view' => 'vcAdminPostTitle',
        'params' => [
            'talent' => [
                'type' => 'dropdown',
                'heading' => 'Select Talent',
                'param_name' => 'talent_id',
                'value' => [],
                'description' => 'Select the talent to display.',
                'admin_label' => true
            ]
        ]
    ];

    protected function populateConfigOptions()
    {
        $this->setTalent();
    }

    protected function setTalent()
    {
        $options['-- Select Talent --'] = '';
        $TalentRepository = new TalentRepository();
        foreach ($TalentRepository->findAll() as $Talent) {
            /* @var TalentPost $Talent */
            $options[$this->getTalentTitleWithRole($Talent)] = $Talent->ID;
        }
        $this->component_config['params']['talent']['value'] = $options;
    }

    protected function createView(array $atts)
    {
        if (empty($atts['talent_id'])) {
            return '';
        }
        $ViewClass = static::VIEW;
        /* TODO: Set default talent modal style in CMS */
        ModalView::load('talent-card-modal', ModalView::TYPE_BOX);
        return new $ViewClass(new TalentPost($atts['talent_id']));
    }

    protected function getTalentTitleWIthRole($Talent)
    {
        $title = $Talent->title();
        return !empty($role = $Talent->role) ? sprintf('%s (%s)', $title, $role) : $title;
    }
}

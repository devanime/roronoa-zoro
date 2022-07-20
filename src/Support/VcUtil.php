<?php

namespace DevAnime\RoronoaZoro\Support;

/**
 * Class VcUtil
 * @package DevAnime\RoronoaZoro\Support
 * @author DevAnime <devanimecards@gmail.com>
 * @version 1.0
 */
class VcUtil
{
    public static function filterArray(array $array, string $filter_name)
    {
        $array = array_values(apply_filters('devanime/roronoa-zoro/' . $filter_name, $array));
        return $array;
    }

    public static function isEditFormForBlock()
    {
        return isset($_POST['action']) &&
            $_POST['action'] == 'vc_edit_form'
            && get_post_type($_POST['post_id']) == 'block';
    }
}

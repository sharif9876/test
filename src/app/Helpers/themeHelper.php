<?php

/**
 * has_permissions
 */

if(!function_exists('has_permissions')) {
    function has_permissions($permissions) {
        (array) $permissions;
        foreach($permissions as $permission) {
            //check user permissions
        }
        return true;
    }
}

/**
 * load_icon
 */

if(!function_exists('load_icon')) {
    function load_icon($icon_name) {
        return '<i class="fa fas far fal fab fa-'.$icon_name.'"></i>';
    }
}

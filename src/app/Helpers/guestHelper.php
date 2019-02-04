<?php

/**
 * menu_app_main
 */

if(!function_exists('menu_guest_main')) {
    function menu_guest_main() {
        $menu_items = [
            'home' => [
                'name' => 'home',
                'display_name' => 'dashboard',
                'slug' => 'menuitem_home',
                'site_url' => 'home',
                'permissions' => []
            ]
        ];

        $menu = [];

        foreach($menu_items as $item) {
            if(has_permissions($item['permissions'])) {
                $menu[$item['name']] = $item;
            }
        }

        return $menu;
    }
}

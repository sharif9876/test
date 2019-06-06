<?php

/**
 * menu_app_main
 */

if(!function_exists('menu_app_main')) {
    function menu_app_main() {
        $menu_items = [
            'home' => [
                'name' => 'home',
                'display_name' => 'dashboard',
                'slug' => 'menuitem_home',
                'site_url' => 'home',
                'permissions' => []
            ],
             'invite' => [
                'name' => 'invite',
                'display_name' => 'invite',
                'slug' => 'menuitem_invite',
                'site_url' => 'invite',
                'permissions' => []
            ],
            'code' => [
                'name' => 'code',
                'display_name' => 'code',
                'slug' => 'menuitem_code',
                'site_url' => 'code',
                'permissions' => []
            ],
            'logout' => [
                'name' => 'logout',
                'display_name' => 'logout',
                'slug' => 'menuitem_logout',
                'site_url' => 'logout',
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

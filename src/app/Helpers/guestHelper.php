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
            ],
            'about' => [
                'name' => 'about',
                'display_name' => 'about',
                'slug' => 'menuitem_about',
                'site_url' => 'about',
                'permissions' => []
            ],
            'terms of service' => [
                'name' => 'terms of service',
                'display_name' => 'terms of service',
                'slug' => 'menuitem_terms_of_service',
                'site_url' => 'termsofservice',
                'permissions' => []
            ],
            'privacy policy' => [
                'name' => 'privacy_policy',
                'display_name' => 'privacy policy',
                'slug' => 'menuitem_privacy_policy',
                'site_url' => 'privacypolicy',
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

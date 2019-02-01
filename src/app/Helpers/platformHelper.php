<?php

/**
 * menu_admin_sidebar
 */

if(!function_exists('menu_admin_sidebar')) {
    function menu_admin_sidebar() {
        $menu_items = [
            'dashboard' => [
                'name' => 'dashboard',
                'display_name' => 'dashboard',
                'slug' => 'menuitem_dashboard',
                'site_url' => 'admin/dashboard',
                'icon' => 'home',
                'permissions' => [],
                'submenu' => []
            ],
            'users' => [
                'name' => 'users',
                'display_name' => 'users',
                'slug' => 'menuitem_users',
                'site_url' => 'admin/users',
                'icon' => 'user',
                'permissions' => [],
                'submenu' => [
                    'users-all' => [
                        'name' => 'users-all',
                        'display_name' => 'all users',
                        'slug' => 'menuitem_users-all',
                        'site_url' => 'admin/users',
                        'permissions' => []
                    ]
                ]
            ],
            'tasks' => [
                'name' => 'tasks',
                'display_name' => 'tasks',
                'slug' => 'menuitem_tasks',
                'site_url' => 'admin/tasks',
                'icon' => 'clipboard',
                'permissions' => [],
                'submenu' => [
                    'tasks-all' => [
                        'name' => 'tasks-all',
                        'display_name' => 'all tasks',
                        'slug' => 'menuitem_tasks-all',
                        'site_url' => 'admin/tasks',
                        'permissions' => []
                    ],
                    'task-entries' => [
                        'name' => 'task-entries',
                        'display_name' => 'task entries',
                        'slug' => 'menuitem_task-entries',
                        'site_url' => 'admin/tasks/entries',
                        'permissions' => []
                    ]
                ]
            ],
            'questions' => [
                'name' => 'questions',
                'display_name' => 'questions',
                'slug' => 'menuitem_questions',
                'site_url' => 'admin/questions',
                'icon' => 'lightbulb',
                'permissions' => [],
                'submenu' => [
                    'questions-all' => [
                        'name' => 'questions-all',
                        'display_name' => 'all questions',
                        'slug' => 'menuitem_questions-all',
                        'site_url' => 'admin/questions',
                        'permissions' => []
                    ]
                ]
            ],
            'settings' => [
                'name' => 'settings',
                'display_name' => 'settings',
                'slug' => 'menuitem_setitngs',
                'site_url' => 'admin/settings',
                'icon' => 'cog',
                'permissions' => [],
                'submenu' => [
                    'settings-general' => [
                        'name' => 'settings-general',
                        'display_name' => 'general',
                        'slug' => 'menuitem_settings-general',
                        'site_url' => 'admin/settings',
                        'permissions' => []
                    ]
                ]
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

<?php

return [
    [
        'route' => 'admin.index',
        'icon' => '<i class="material-icons">home</i>',
        'text' => 'Home'
    ],
    [
        'constructor' => 'users.index',
        'icon' => '<i class="material-icons">account_box</i>',
        'text' => 'Users',
        'permission' => 'admin:users',
        'counter' => [
            'value' => function () {
                $model = config('hush.app.user.model');
                return $model::count();
            },
            'color' => 'hsl(269, 100%, 37%)'
        ]
    ],
    [
        'constructor' => 'settings.index',
        'icon' => '<i class="material-icons">settings</i>',
        'text' => 'Settings',
        'permission' => 'admin:users'
    ],
];

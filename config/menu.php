<?php

return [
    [
        'constructor' => 'users.index',
        'icon' => '<i class="material-icons">account_box</i>',
        'text' => 'users',
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
        'text' => 'settings',
        'permission' => 'admin:users'
    ],
];

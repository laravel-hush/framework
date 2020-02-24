<?php

use App\User;

return [
    'get' => [
        'class' => null,
        'title' => 'users',
        'breadcrumbs' => ['users' => null],
        'permission' => 'admin:users',

        'blocks' => [
            [
                'class' => 'col-lg-12',

                'title' => [
                    'text' => 'users',
                    'add' => 'admin:users_add',
                    'search' => true
                ],

                'content' => [
                    'type' => 'table',
                    'pagination' => true,
                    'modal' => true,
                    'edit' => 'admin:users_edit',
                    'delete' => 'admin:users_delete',
                    'rows' => function () {
                        $userClass = config('hush.app.user.model');
                        return (new $userClass)->paginate();
                    },
                    'columns' => [
                        'id' => ['sortable', 'searchable'],
                        'name' => ['sortable', 'searchable']
                    ],
                    'actions' => [
                        [
                            'icon' => 'remove_red_eye',
                            'text' => 'show'
                        ]
                    ],
                ]

            ]
        ]
    ],

    'delete' => [

        'delete' => [
            'permission' => 'admin:users_delete',
            'rules' => [],
            'closure' => function () {
                User::where('id', request()->id)->delete();

                return [
                    'status' => 'success',
                    'reload' => true,
                    'swal' => [
                        'title' => 'Deleted',
                        'text' => 'User was deleted successfully',
                        'type' => 'success'
                    ]
                ];
            }
        ],

    ]
];

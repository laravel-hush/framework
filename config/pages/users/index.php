<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Page settings
    |--------------------------------------------------------------------------
    */

    'default' => [
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

                /*
                |--------------------------------------------------------------
                | Block content
                |--------------------------------------------------------------
                */

                'content' => [
                    'type' => 'table',
                    'pagination' => true,
                    'modal' => true,
                    'edit' => 'admin:users_edit',
                    'delete' => 'admin:users_delete',
                    'rows' => function () {
                        return User::paginate();
                    },
                    'columns' => [
                        'id' => ['sortable' => true],
                        'name' => ['sortable' => true],
                        'email' => ['sortable' => true]
                    ],
                    'actions' => [
                        [
                            'icon' => 'remove_red_eye',
                            'text' => 'show'
                        ]
                    ],
                    'multiple-actions' => [
                        [
                            'type' => 'delete',
                            'text' => 'delete-selected',
                            'confirmation' => true,
                            'link' => 'action:delete-multiple'
                        ]
                    ]
                ]

            ],

            // another block
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Page actions
    |--------------------------------------------------------------------------
    */

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
                        'title' => __('hush::admin.deleted'),
                        'text' => __('hush::admin.operation-success'),
                        'type' => 'success'
                    ]
                ];
            }
        ],

        'delete-multiple' => [
            'permission' => 'admin:users_delete',
            'rules' => [],
            'closure' => function () {
                User::whereIn('id', request()->items)->delete();

                return [
                    'status' => 'success',
                    'items' => request()->items,
                    'reload' => true,
                    'swal' => [
                        'title' => __('hush::admin.deleted'),
                        'text' => __('hush::admin.operation-success'),
                        'type' => 'success'
                    ]
                ];
            }
        ]

    ]
];

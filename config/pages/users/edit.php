<?php

use App\Models\User;
use ScaryLayer\Hush\Models\Role;

return [

    /*
    |--------------------------------------------------------------------------
    | Page settings
    |--------------------------------------------------------------------------
    */

    'default' => [
        'class' => null,
        'title' => 'user',
        'breadcrumbs' => [
            'users' => 'page:admin.users',
            'edit' => null,
        ],
        'permission' => ['admin:users_add', 'admin:users_edit'],

        'closure' => function () {
            return ['model' => User::findOrNew(request()->id)];
        },


        'blocks' => [
            [
                'class' => 'col-12',

                'title' => [
                    'text' => 'users',
                    'buttons' => [
                        [
                            'form' => 'users',
                            'text' => 'save',
                            'icon' => 'save',
                            'class' => 'btn-primary'
                        ],
                    ],
                ],

                /*
                |--------------------------------------------------------------
                | Block content
                |--------------------------------------------------------------
                */

                'content' => [
                    'type' => 'form',
                    'id' => 'users',
                    'link' => 'action:save',
                    'grid' => [
                        [
                            'size' => 'col-6',
                            'inputs' => [
                                [
                                    'type' => 'hidden',
                                    'name' => 'id'
                                ],
                                [
                                    'type' => 'select',
                                    'name' => 'role',
                                    'options' => function () {
                                        return Role::orderBy('key')->get()->pluck('key', 'key');
                                    },
                                    'label' => 'role'
                                ],
                                [
                                    'type' => 'text',
                                    'name' => 'name',
                                    'label' => 'name'
                                ],
                            ]
                        ],
                        [
                            'size' => 'col-6',
                            'inputs' => [
                                [
                                    'label' => 'email',
                                    'placeholder' => 'email',
                                    'type' => 'email',
                                    'name' => 'email',
                                    'field' => 'email',
                                ],
                            ]
                        ],
                    ],
                ]

            ],

            // another block
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Page actions
    |--------------------------------------------------------------------------
    */

    'post' => [

        'save' => [
            'permission' => ['admin:users_add', 'admin:users_edit'],
            'rules' => function () {
                return [
                    'id' => 'nullable|integer|exists:users,id',
                    'role' => 'required|string|exists:roles,key',
                    'email' => 'required|email|unique:users,email,' . request()->id,
                    'name' => 'required|string'
                ];
            },
            'closure' => function () {
                $user = User::findOrNew(request()->id);
                $user->fill(request()->only('email', 'name'));
                $user->save();

                return [
                    'status' => 'success',
                    'reload' => true,
                    'swal' => [
                        'title' => __('hush::admin.saved'),
                        'text' => __('hush::admin.your-work-has-been-successfully-saved'),
                        'type' => 'success'
                    ]
                ];
            }
        ]

    ],
];

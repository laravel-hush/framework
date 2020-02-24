<?php

use App\User;
use ScaryLayer\Hush\Models\Role;

return [
    'get' => [
        'class' => null,
        'title' => 'user',
        'breadcrumbs' => [
            'users' => '/admin/users',
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

                'content' => [
                    'id' => 'users',
                    'type' => 'form',
                    'constructor' => [
                        'route' => 'admin.constructor.process',
                        'action' => 'save'
                    ],
                    'inputs' => [
                        [
                            'type' => 'hidden',
                            'name' => 'id',
                            'field' => 'id'
                        ],
                        [
                            'width' => 'col-12',
                            'label' => 'role',
                            'placeholder' => 'role',
                            'type' => 'select',
                            'name' => 'role',
                            'field' => 'role',
                            'data' => function () {
                                return Role::orderBy('key')->get()->pluck('key', 'key');
                            }
                        ],
                        [
                            'width' => 'col-12',
                            'label' => 'name',
                            'placeholder' => 'name',
                            'type' => 'text',
                            'name' => 'name',
                            'field' => 'name',
                        ],
                        [
                            'width' => 'col-12',
                            'label' => 'email',
                            'placeholder' => 'email',
                            'type' => 'email',
                            'name' => 'email',
                            'field' => 'email',
                        ],
                    ]
                ]

            ]
        ],
    ],


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
                        'title' => 'Saved',
                        'text' => 'You work was successfully saved.',
                        'type' => 'success'
                    ]
                ];
            }
        ]

    ],
];

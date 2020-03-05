<?php

use App\User;
use ScaryLayer\Hush\Models\Role;

return [

    /*
    |--------------------------------------------------------------------------
    | Page settings
    |--------------------------------------------------------------------------
    |
    | Page settings located inside get attribute. It contains class, title,
    | breadcrumbs, permission and blocks attributes. Each block has class "col"
    | and located inside div with "row" class. If you need to set some
    | additional classes for "row" you can do this by class attribute.
    |
    | Also here can be set closure for sending custom attributes to view. For
    | example you should use this for sending model to edit pages.
    |
    | Each block contains from class, title and content.
    | Block class may be responsible for block flex size.
    |
    */

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

                /*
                |--------------------------------------------------------------
                | Block title
                |--------------------------------------------------------------
                |
                | Title is responsible for block title's text and buttons,
                | which will be displayed in it's right corner.
                |
                | Each button contains from text, icon, class and link/form.
                | Link should be setted as described in docs section Linking.
                |
                | It has some default buttons, such as add and search. For
                | using it you just have to declare attribute with it name and
                | use permission name or true as it's value.
                |
                */

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
                |
                | Content attributes depends on type. Currently support types
                | form and table.
                |
                | You may read about content type attributes in docs section
                | Blocks.
                |
                */

                'content' => [
                    'type' => 'form',
                    'id' => 'users',
                    'constructor' => [
                        'route' => 'admin.constructor.process',
                        'action' => 'save'
                    ],
                    'grid' => [
                        [
                            'size' => 'col-6',
                            'inputs' => [
                                [
                                    'type' => 'hidden',
                                    'name' => 'id',
                                    'field' => 'id'
                                ],
                                [
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
                                    'label' => 'name',
                                    'placeholder' => 'name',
                                    'type' => 'text',
                                    'name' => 'name',
                                    'field' => 'name',
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

            ]
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Page actions
    |--------------------------------------------------------------------------
    |
    | This is an additional requests that the page applies to. You can create
    | closures for delete, patch, post and put requests here.
    |
    | Each request method may have multiple actions. Each action contains from
    | required attributes (rules and closure) and optional (messages and
    | attributes)
    |
    | Rules, messages and attributes may be array or closure.
    |
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
                        'title' => 'Saved',
                        'text' => 'You work was successfully saved.',
                        'type' => 'success'
                    ]
                ];
            }
        ]

    ],
];

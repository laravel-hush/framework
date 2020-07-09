<?php

use App\User;

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
        'title' => 'users',
        'breadcrumbs' => ['users' => null],
        'permission' => 'admin:users',

        'blocks' => [
            [
                'class' => 'col-lg-12',

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
                    'add' => 'admin:users_add',
                    'search' => true
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
                            'constructor' => [
                                'route' => 'admin.constructor.process',
                                'action' => 'delete-multiple'
                            ]
                        ]
                    ]
                ]

            ]
        ]
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

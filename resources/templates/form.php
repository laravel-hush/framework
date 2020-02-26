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
        'title' => 'item',
        'breadcrumbs' => [
            'edit' => null,
        ],
        'permission' => ['admin:items_add', 'admin:items_edit'],

        'closure' => function () {
            // should be returned ['model']
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
                    'text' => 'items',
                    'buttons' => [
                        //
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
                    'id' => 'items',
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

                        // another inputs
                    ]
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
            'permission' => ['admin:items_add', 'admin:items_edit'],
            'rules' => function () {
                // validation rules
            },
            'closure' => function () {
                // some actions
                // if nothing returned here than will be returned default response
            }
        ]

    ],
];

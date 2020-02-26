<?php

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
        'class' => '',
        'title' => 'items',
        'breadcrumbs' => ['items' => null],
        'permission' => '',

        'blocks' => [
            [
                'class' => '',

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
                    'add' => 'admin:items_add',
                    'search' => true,
                    'buttons' => [
                        //
                    ]
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
                    'edit' => 'admin:items_edit',
                    'delete' => 'admin:items_delete',
                    'rows' => function () {
                        // must return array of objects
                    },
                    'columns' => [
                        'id' => ['sortable' => true],
                        'field' => ['sortable' => true]
                    ],
                    'actions' => [
                        //
                    ],
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
            'permission' => 'admin:items_delete',
            'rules' => [
                // validation rules
            ],
            'closure' => function () {
                // some actions
                // if nothing returned here than will be returned default response
            }
        ],

    ]
];

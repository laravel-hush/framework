<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Page settings
    |--------------------------------------------------------------------------
    */

    'default' => [
        'class' => null,
        'breadcrumbs' => ['settings' => null],

        'blocks' => [
            [
                'class' => 'col-12',

                'title' => [
                    'text' => 'settings',
                    'buttons' => [
                        [
                            'form' => 'settings',
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
                    'id' => 'settings',
                    'link' => 'action:save',
                    'inputs' => [
                        //
                    ]
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
            'rules' => [],
            'closure' => function () {
                //
            }
        ]

    ],


    'delete' => [

        'delete' => [
            'rules' => ['id' => 'required|integer|exists:settings,id'],
            'closure' => function () {
                //
            }
        ]

    ],
];

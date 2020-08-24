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
                        [
                            'width' => 'col-6',
                            'label' => 'sitename',
                            'placeholder' => 'placeholder',
                            'type' => 'text',
                            'name' => 'sitename'
                        ],
                        [
                            'width' => 'col-6',
                            'label' => 'setting',
                            'placeholder' => 'placeholder',
                            'type' => 'select',
                            'name' => 'setting'
                        ]
                    ]
                ]

            ]
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

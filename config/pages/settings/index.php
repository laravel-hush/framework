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
        'permission' => 'admin:settings',

        'closure' => function () {
            // should be returned ['model']
        },

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
                        // list of setting inputs
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

<?php

return [

    'get' => [
        'class' => null,
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

                'content' => [
                    'id' => 'settings',
                    'type' => 'form',
                    'constructor' => [
                        'route' => 'admin.constructor.process',
                        'action' => 'save'
                    ],
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

<?php

return [
    'blocks' => [
        [
            /*=================================================================
            | Block settings
            =================================================================*/
            'width' => 8,
            'title' => 'settings',
            'buttons' => [
                [
                    'text' => 'save',
                    'icon' => 'save',
                    'class' => 'btn-success'
                ],
            ],

            /*=================================================================
            | Block content
            =================================================================*/
            'type' => 'form',
            'inputs' => [
                [
                    'width' => '6',
                    'label' => 'sitename',
                    'placeholder' => 'placeholder',
                    'type' => 'text',
                    'name' => 'sitename'
                ],
                [
                    'width' => '6',
                    'label' => 'setting',
                    'placeholder' => 'placeholder',
                    'type' => 'select',
                    'name' => 'setting'
                ]
            ]
        ]
    ]
];
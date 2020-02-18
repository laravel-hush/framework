<?php

return [
    'blocks' => [
        [
            /*=================================================================
            | Block settings
            =================================================================*/
            'width' => 8,
            'title' => 'users',
            'buttons' => [
                [
                    'text' => 'add',
                    'icon' => 'add'
                ],
                [
                    'text' => 'filter',
                    'icon' => 'filter_list'
                ],
                [
                    'text' => 'save',
                    'icon' => 'save',
                    'class' => 'btn-success'
                ],
            ],


            /*=================================================================
            | Block content
            =================================================================*/
            'type' => 'table',
            'pagination' => true,
            'edit' => true,
            'delete' => true,
            'rows' => function () {
                return \App\User::orderBy('name')->get();
            },
            'columns' => [
                'id' => ['sortable', 'searchable'],
                'name' => ['sortable', 'searchable']
            ],
            'actions' => [
                [
                    'icon' => 'remove_red_eye',
                    'text' => 'show'
                ]
            ],

        ]
    ]
];
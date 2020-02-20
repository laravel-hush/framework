<?php

return [
    'get' => [
        'class' => null,
        'blocks' => [
            [
                'class' => 'col-lg-12',
                'title' => [
                    'text' => 'users',
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
                ],

                'content' => [
                    'type' => 'table',
                    'pagination' => true,
                    'edit' => true,
                    'delete' => true,
                    'rows' => function () {
                        $userClass = config('hush.app.user.model');
                        return (new $userClass)->orderBy('name')->paginate();
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
        ]
    ]
];

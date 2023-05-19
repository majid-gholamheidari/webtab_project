<?php

return [
    'users' => [
        'gender' => [
            'male' => 0,
            'female' => 1
        ]
    ],
    'comments' => [
        'status' => [
            'accepted' => 1,
            'rejected' => 0,
            'pending' => 2
        ],
        'reversedStatus' => [
            0 => 'rejected',
            1 => 'accepted',
            2 => 'pending'
        ]
    ]
];

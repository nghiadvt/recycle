<?php
return [
    'response' => [
        'get' => [
            'success' => 'Get :name successfully!',
            'fail' => 'Get :name fail!',
        ],
        'store' => [
            'success' => 'Add :name successfully!',
            'fail' => 'Add :name fail!',
        ],
        'update' => [
            'success' => 'Update :name successfully!',
            'fail' => 'Update :name fail!',
        ],
        'delete' => [
            'success' => 'Delete :name successfully!',
            'fail' => 'Delete :name fail!',
        ],
        'login' => [
            'success' => 'Login successfully!',
            'fail' => 'The email or password is incorrect!',
        ],
        'logout' => [
            'success' => 'User successfully signed out!',
            'fail' => 'User logout fail!',
        ],
        'token' => [
            'fail' => 'Invalid token, please login again!',
        ],
        'mail' => [
            'reportPlace' => [
                'success' =>
                    'Thank for your feedback. We will try to respond as soon as possiple!',
                'fail' => 'Report place fail',
            ],
        ],
    ],
];

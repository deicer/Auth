<?php

return [
    'routes' =>
        [
            '/' => 'MainController@index',
            '/login' => 'AuthController@login',
            '/register' => 'AuthController@register',
            '/profile' => 'MainController@profile'
        ]
];

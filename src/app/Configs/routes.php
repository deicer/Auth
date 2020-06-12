<?php

return [
    'routes' => [
        '/'             => 'MainController@index',
        '/login'        => 'AuthController@login',
        '/register'     => 'AuthController@register',
        '/logout'       => 'AuthController@logout',
        '/profile'      => 'MainController@profile',
        '/profile/edit' => 'MainController@profileEdit',
    ],
];

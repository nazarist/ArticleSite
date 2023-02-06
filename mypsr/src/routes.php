<?php



return [
    //main
    '~^$~' => [MyProject\Controllers\MainController::class, 'main'],
    //user
    '~^pofile/([\w\.]+)$~' => [MyProject\Controllers\UserController::class, 'userProfile'],
    '~^sign-up$~' => [MyProject\Controllers\UserController::class, 'singUp'],
    '~^login$~' => [MyProject\Controllers\UserController::class, 'login'],
    '~^exit$~' => [MyProject\Controllers\UserController::class, 'exit'],
    //articles
    '~^articles/(\d+)$~' => [MyProject\Controllers\ArticlesController::class, 'articles'],
    '~^create$~' => [MyProject\Controllers\ArticlesController::class, 'create'],
];
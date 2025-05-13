<?php

return [
    // Renderer
    'DB_HOST'         => 'localhost',
    'DB_NAME'         => 'site',
    'DB_USER'         => 'admin',
    'DB_PASS'         => '8df37bfcf014e1faf259c6779b478f874d22662b423cd734',
    'SERIOUS_KEY'     => 'jpisfitBricksOfDicks',
    'ALLOWED_TYPES'   => ['item', 'user', 'preview'],
    'FOCUS_ITEMS'     => false,
    'FACES_PNG'       => true,

    // Site
    'SITE_NAME' => 'Brick Hill',

    // Directories
    'DIRECTORIES' => [
        'ROOT'       => '/var/www/storage',
        'UPLOADS'    => '/var/www/storage/uploads',
        'THUMBNAILS' => '/var/www/storage/thumbnails'
    ],

    // Colors
    'ITEM_BODY_COLOR' => '#d3d3d3',

    // Avatar
    'AVATARS' => [
        'DEFAULT' => '/var/www/Brick-Hill/renderer/blend/avasquare/avatar.blend',
        'TOOL'  => '/var/www/Brick-Hill/renderer/blend/avasquare/nobevel_tool.blend',
    ],

    // Headshot Camera
    'HEADSHOT_CAMERA' => [
        'LOCATION' => [
            'X' => '-0.633156',
            'Y' => '-1.86332',
            'Z' => '2.68582'
        ],

        'ROTATION' => [
            'X' => '79.56214',
            'Y' => '-0.3928324',
            'Z' => '-18.81374'
        ]
    ],

    // Image Sizes
    'IMAGE_SIZES' => [
        'USER_AVATAR'   => 512,
        'USER_HEADSHOT' => 256,
        'ITEM'          => 375
    ]
];

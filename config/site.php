<?php
$aU = env('ASSET_URL');

return [
    'name' => env('APP_NAME', 'Brick Hill'),
    'logo' => $aU . '/images/logos/bh_small.png',
    'icon' => $aU . '/images/logos/bh_icon.png',
    'theme_color' => '#00A9FE',

    'route_domains' => [
        'main_site' => 'brick-hill.co',
        'admin_site' => 'admin.brick-hill.co'
    ],

    'storage_url' => env('STORAGE_URL'),
    'discord_url' => '',
    'emails' => [
        'support' => 'help@brick-hill.co',
        'moderation' => 'appeals@brick-hill.co'
    ],

    'system_user_id' => 1,
    'news_topic_id' => 1,
    'rules_thread_id' => 1,
    'saint_item_id' => null,

    'username_change_price' => 250,
    'clan_creation_price' => 25,

    'flood_time' => 5,
    'forum_age_requirement' => 0,
    'message_age_requirement' => 3,

    'renderer' => [
        'url' => env('RENDER_URL'),
        'key' => env('RENDER_KEY'),
        'default_filename' => '7Nr5llNgVgiHUsBjw7mc'
    ],

    'admin_panel_code' => '',
    'maintenance_passwords' => [
        'One Sec'
    ]
];

<?php
return [
    'token' => env('DISCORD_USER_INFO_TOKEN'),

    'server_id' => null,
    'role_ids' => [
        'membership' => null,
        'donator' => null,
        'verified' => null
    ],

    'item_notifier_webhooks' => [
    ]
];

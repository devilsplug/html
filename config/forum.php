<?php
// the "sections" are the top, so for example, on BH it's Site, random, workshop, the title is the same, topic ID is the id's of the boards, color is well, color...
return [
    'sections' => [
        'admin' => [
            'title' => 'Admin', // title
            'topicIds' => [15], // topic id
            'cardColor' => 'red', // color
        ],
        'site' => [
            'title' => env('APP_NAME'), // title
            'topicIds' => [1, 3, 4, 5, 8], // topic id
            'cardColor' => 'blue', // color
        ],
        'random' => [
            'title' => 'Random', // title
            'topicIds' => [2, 7, 9, 10, 11], // topic id
            'cardColor' => 'green', // color
        ],
        'workshop' => [
            'title' => 'Workshop', // title
            'topicIds' => [12, 13, 14], // topic id
            'cardColor' => 'orange', // color
        ],
    ],
];

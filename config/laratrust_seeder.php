<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
             'gain'=> 'c,r,u,d',
             'cash'=> 'c,r,u,d',
             'returnorderclient'=>'c,r,u,d' ,
             'orderclient'=> 'c,r,u,d',
            'orders' => 'c,r,u,d',
        ],
        'admin'=>[
            'returnorderclient'=>'c,r,u,d' ,
            'orderclient'=> 'c,r,u,d',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

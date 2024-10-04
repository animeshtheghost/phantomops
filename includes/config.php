<?php

return [

    'db' => [

        'host' => 'localhost',

        'dbname' => 'contact_db', //database name could be hard coded into php scripts

        'username' => 'username',//also note that there needs to be two tables
                                // to handle incoming data from the users namely "contact_form_submissions" and "login_logs"

        'password' => 'password'

    ],

    'admin' => [

        'username' => 'admin-username', // admin username change as needed 

        'password' => 'admin-password'  // admin password changed as needed 

    ]

];


<?php
// all the available pages are stored here

return array (
    'home'  => array (
        'title'     => 'Home page',
        'in_menu'   => TRUE,
        'content'   => 'home.php'
    ),
    'books' => array (
        'title'     => 'Books page',
        'in_menu'   => TRUE,
        'content'   => 'books.php'
    ),
    'user'  => array (
        'title'     => 'User page',
        'in_menu'   => TRUE,
        'content'   => 'user.php'
    ),
    'admin' => array (
        'title'     => 'Admin page',
        'in_menu'   => TRUE,
        'content'   => 'admin.php'
    ),
    'mysql' => array (
        'in_menu'   => FALSE,
        'content'   => 'admin.php'
    )

);

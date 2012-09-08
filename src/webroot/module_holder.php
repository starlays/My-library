<?php
// all the available pages are stored here

return array (
    'home'  => array (
        'title'     => 'Home page',
        'in_menu'   => 1,
        'content'   => 'home.php'
    ),
    'books' => array (
        'title'     => 'Books page',
        'in_menu'   => 1,
        'content'   => 'books.php'
    ),
    'user'  => array (
        'title'     => 'User page',
        'in_menu'   => 1,
        'content'   => 'user.php'
    ),
    'admin' => array (
        'title'     => 'Admin page',
        'in_menu'   => 1,
        'content'   => 'admin.php'
    ),
    'mysql' => array (
        'in_menu'   => 0,
        'content'   => 'mysql.php'
    ),
     'register' => array (
        'title'     => 'Register',
        'in_menu'   => 2,
        'content'   => 'register.php'
    ),
     'login' => array (
        'title'     => 'Login',
        'in_menu'   => 2,
        'content'   => 'login.php'
    ),
     'recover' => array (
        'title'     => 'Recover',
        'in_menu'   => 2,
        'content'   => 'recover.php'
    )
);

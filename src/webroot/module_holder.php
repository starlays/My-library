<?php
// all the available pages are stored here

return array (
    'home'  => array (
        'title'     => 'Home page',
        'in_menu'   => 1,
        'content'   => 'home.php',
    ),
    'books' => array (
        'title'     => 'Books page',
        'in_menu'   => 1,
        'content'   => 'books.php',
        'depend'    => array('mysql')
    ),
    'user'  => array (
        'title'     => 'User page',
        'in_menu'   => 1,
        'content'   => 'user.php',
        'depend'    => array('mysql')
    ),
    'admin' => array (
        'title'     => 'Admin page',
        'in_menu'   => 1,
        'content'   => 'admin.php',
        'depend'    => array('mysql')
    ),
    'mysql' => array (
        'in_menu'   => 0,
        'content'   => 'mysql.php'
    ),
     'register' => array (
        'title'     => 'Register',
        'in_menu'   => 2,
        'content'   => 'register.php',
        'depend'    => array('mysql')
    ),
     'login' => array (
        'title'     => 'Login',
        'in_menu'   => 2,
        'content'   => 'login.php',
        'depend'    => array('mysql')
    ),
     'recover' => array (
        'title'     => 'Recover',
        'in_menu'   => 2,
        'content'   => 'recover.php',
        'depend'    => array('mysql')
    )
);

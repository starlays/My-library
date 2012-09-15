<?php
// all the available pages are stored here

return array (
    'home'  => array (
        'title'         => 'Home page',
        'in_menu'       => 1,
        'content_VL'    => 'home.php'
    ),
    'books' => array (
        'title'         => 'Books page',
        'in_menu'       => 1,
        'content_VL'    => 'books.php',
        'content_BL'    => 'books_bl.php',
        'resources'     => array('mysql')
    ),
    'user'  => array (
        'title'         => 'User page',
        'in_menu'       => 1,
        'pre-processing'=> array(
               'session'=>'session_start.php',
        ),
        'content_VL'    => 'user.php',
        'content_BL'    => 'user_bl.php',
        'depend'        => array('books'),
        'resources'     => array('mysql')
    ),
    'admin' => array (
        'title'         => 'Admin page',
        'in_menu'       => 1,
        'content_VL'    => 'admin.php',
        'resources'     => array('mysql')
    ),
     'register' => array (
        'title'         => 'Register',
        'in_menu'       => 2,
        'content_VL'    => 'register.php',
        'content_BL'    => 'register_BL.php',
        'resources'     => array('mysql')
    ),
     'login' => array (
        'title'         => 'Login',
        'in_menu'       => 2,
        'pre-processing'      => array(
            'session' => 'session_start.php',
            'login' => 'login_check.php',
        ),
        'content_VL'    => 'login.php',
        'content_BL'    => 'login_BL.php',
        'resources'     => array('mysql'),
    ),
     'recover' => array (
        'title'         => 'Recover',
        'in_menu'       => 2,
        'content_VL'    => 'recover.php',
        'resources'     => array('mysql')
    ),
     'logout' => array (
        'title'         => 'Logout',
        'in_menu'       => 2,
        'pre-processing'      => array(
            'session' => 'session_destroy.php',
        ),
        'content_VL'    => 'logout.php',
    ),
);

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
        'depend'        => array('mysql')
    ),
    'user'  => array (
        'title'         => 'User page',
        'in_menu'       => 1,
        'content_VL'    => 'user.php',
        'depend'        => array('mysql')
    ),
    'admin' => array (
        'title'         => 'Admin page',
        'in_menu'       => 1,
        'content_VL'    => 'admin.php',
        'depend'        => array('mysql')
    ),
    'mysql' => array (
        'in_menu'       => 0,
        'content_VL'    => 'mysql.php'
    ),
     'register' => array (
        'title'         => 'Register',
        'in_menu'       => 2,
        'content_VL'    => 'register.php',
		'content_BL'    => 'register_BL.php',
        'depend'        => array('mysql')
    ),
     'login' => array (
        'title'         => 'Login',
        'in_menu'       => 2,
        'content_VL'    => 'login.php',
		'content_BL'    => 'login_BL.php',
        'depend'        => array('mysql')
    ),
     'recover' => array (
        'title'         => 'Recover',
        'in_menu'       => 2,
        'content_VL'    => 'recover.php',
        'depend'        => array('mysql')
    ),
     'logout' => array (
        'title'         => 'Logout',
        'in_menu'       => 2,
        'content_VL'   => 'logout.php'
    )
);

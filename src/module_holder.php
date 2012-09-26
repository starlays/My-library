<?php
// all the available pages are stored here

return array (
    'home'      => array (
        'title'         => 'Home page',
        'in_menu'       => 1,
        'content_VL'    => 'home.php'
    ),
    'books'     => array (
        'title'         => 'Books page',
        'in_menu'       => 1,
        'content_VL'    => 'books.php',
        'content_BL'    => 'books_bl.php',
        'resources'     => array('mysql', 'authentication')
    ),
    'user'      => array (
        'title'         => 'User page',
        'in_menu'       => 1,
        'content_VL'    => 'user.php',
        'content_BL'    => 'user_bl.php',
        'depend'        => array('books'),
        'resources'     => array('mysql', 'books', 'authentication')
    ),
    'admin'     => array (
        'title'         => 'Admin page',
        'in_menu'       => 1,
        'content_VL'    => 'admin.php',
        'content_BL'    => 'admin_bl.php',
        'depend'        => array('register'),
        'resources'     => array('mysql', 'authentication')
    ),
     'register' => array (
        'title'         => 'Register',
        'in_menu'       => 2,
        'content_VL'    => 'register.php',
        'content_BL'    => 'register_BL.php',
        'resources'     => array('mysql', 'authentication')
    ),
     'login'    => array (
        'title'         => 'Login',
        'in_menu'       => 2,
        'content_VL'    => 'login.php',
        'content_BL'    => 'login_bl.php',
        'resources'     => array('mysql', 'authentication')
    ),
     'recover'  => array (
        'title'         => 'Recover',
        'in_menu'       => 2,
        'content_VL'    => 'recover.php', //where is the file?
        'resources'     => array('mysql', 'authentication')
    ),
     'logout'   => array (
        'title'         => 'Logout',
        'in_menu'       => 2,
        'content_VL'    => 'logout.php',
        'content_BL'    => 'logout_bl.php',
        'resources'     => array('authentication')
    ),
    'upload'   => array(
        'title'      => 'File upload',
        'in_menu'    => 1,
        'content_VL' => 'upload.php',
        'content_BL' => 'upload_bl.php',
        'resources'     => array('mysql', 'authentication', 'upload')
    )
);

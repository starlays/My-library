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
        'resources'     => array('mysql', 'authentication', 'books')
    ),
    'user'      => array (
        'title'         => 'User page',
        'in_menu'       => 1,
        'content_VL'    => 'user.php',
        'content_BL'    => 'user_bl.php',
        'resources'     => array('mysql', 'authentication', 'books', 'upload', 'user')
    ),
    'admin'     => array (
        'title'         => 'Admin page',
        'in_menu'       => 1,
        'content_VL'    => 'admin.php',
        'content_BL'    => 'admin_bl.php',
        'resources'     => array('mysql', 'authentication','admin')
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
    'upload'   => array(
        'title'         => 'File upload',
        'in_menu'       => 1,
        'content_VL'    => 'upload.php',
        'content_BL'    => 'upload_bl.php',
        'resources'     => array('mysql', 'authentication', 'upload')
    )
);

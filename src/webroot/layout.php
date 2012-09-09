<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="style.css" />

<title><?php echo $modules[$page]['title']; ?></title>

</head>
<body>
<div id="wrapper">

    <div id="picture">
        <p>Picture</p>
    </div>

    <div id="header">
        <?php echo build_menu($page, $modules, 1); ?>
    </div>

    <div id="user-area">
        <?php echo build_menu($page, $modules, 2); ?>
    </div>


<div id="books-wrapper">
<?php
if(check_file($modules[$page]['content'],__MODULES__.$page.DIRECTORY_SEPARATOR)) {
    include (__MODULES__.$page.DIRECTORY_SEPARATOR.$modules[$page]['content']);
}
else {
    echo sprintf('Error: %s page content is missing! Contact website administrator.', $page);
}
?>
</div>
</div>
<div id="footer">
    here goes copyright info
</div>
<body>
</html>

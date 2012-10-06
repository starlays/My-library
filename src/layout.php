<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<title><?php echo $active_page_title; ?></title>
</head>
<body>
<div id="wrapper">
    <div id="picture">
        <p>Logo</p>
    </div>
    <div id="header">
        <?php echo build_menu($active_page, $menu_items, 1); ?>
    </div>
    <div id="user-area">
        <?php echo build_menu($active_page, $menu_items, 2); ?>
    </div>
<div id="books-wrapper">
<?php
if(check_file($menu_items[$active_page]['content_VL'],__MODULES__.$active_page.D_S)) {
    include (__MODULES__.$active_page.D_S.$menu_items[$active_page]['content_VL']);
}
else {
    echo sprintf('Error: %s page content is missing! Contact website administrator.', $active_page);
}
if(isset($errors)) {
    foreach($errors as $error) {
        echo sprintf('Error: %s', $error);
    }
}
?>
</div>
</div>
    <div id="footer">
        here goes copyright info
    </div>
</body>
</html>

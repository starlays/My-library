<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="style.css" />

<title><?php echo $pages[$page]['title']; ?></title>

</head>
<body>
<div id="wrapper">

    <div id="picture">
        <p>Picture</p>
    </div>

    <div id="header">
        <?php build_menu($page, $pages); ?>
    </div>

    <div id="user-area">
        here goes user area
    </div>
</div>

<div id="books-wrapper">
    here goes books info
</div>

<div id="footer">
    here goes copyright info
</div>
<body>
</html>

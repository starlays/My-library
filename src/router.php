<?php
$page = 'home';

if(isset($_GET['page'])) {
    $required_page = htmlspecialchars($_GET['page']);
    if(isset($modules[$required_page]) && $modules[$required_page]['in_menu']) {
        $page = $required_page;
    }
}

return $page;

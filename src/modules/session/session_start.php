<?php
session_start();
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === 1) {
    header('Location: index.php');
}
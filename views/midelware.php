<?php

if (isset($_COOKIE['role'])) {
    $cookieRole = $_COOKIE['role'];
    $cookieUserName = $_COOKIE['userName'];
} else {
    header('Location: ' . "./index.html");
            exit;
}
?>

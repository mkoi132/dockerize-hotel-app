<?php
session_start();
if (isset($_COOKIE['access_token'])) {
    unset($_COOKIE['access_token']);
    setcookie('access-token', null, -3600);
}
session_unset();
session_destroy();
header("Location:index.php");
exit(0);

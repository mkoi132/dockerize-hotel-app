<?php
session_start();
include("incl/db_connect.inc");

$sql = "select * from users where username = ? and password = SHA(?)";
$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $connection->prepare($sql);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['username'] = $username;
    $accessToken = bin2hex(random_bytes(32)); // Generate a random string as the access token
    $_SESSION['access_token'] = $accessToken; // Store the access token in the server, associating it with the user session
    setcookie('access_token', $accessToken, time() + 3600); // store the same thing but on client side cookie.
    // the idea is after the hold time, the access token in cookie will expired, no longer match with the one on session.
    //user will need to login again to get a new token.
    header("Location:index.php?message=logsuccess");
} else {
    header("Location:login.php?message=logerror");
}
$connection->close();

exit(0);

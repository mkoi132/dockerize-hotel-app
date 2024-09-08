<?php
include("incl/db_connect.inc");
function validateIn($str)
{
    $validIn = trim($str);
    return $validIn;
}

$sql = "insert into users (username, password, reg_date) values (?, SHA(?), now())";
$username = validateIn($_POST['username']);
$password = validateIn($_POST['password']);

$stmt = $connection->prepare($sql);

$stmt->bind_param("ss", $username, $password);

$stmt->execute();
if ($stmt->affected_rows > 0) {
    //back to home
    header("Location:login.php?message=regsuccess");
} else {
    header("Location:register.php?message=logerror");
}
$connection->close();

exit(0);

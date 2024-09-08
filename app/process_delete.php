<?php
include('incl/db_connect.inc');
session_start();

if (isset($_GET['id'])) {
    $facilityID = $_GET['id'];

    // Perform the delete query
    $sql = "DELETE FROM facilities WHERE facilityid = $facilityID";
    $record = $connection->query($sql);
    if (!$record) {
        die("Error in SQL db: " . mysqli_error($connection));
    } else if ($connection->affected_rows > 0) {
        $_SESSION['usrmsg'] = "That facility is gone!";
        header("Location:index.php?");
    }
} else {
    echo "Invalid request. Facility ID not provided.";
}

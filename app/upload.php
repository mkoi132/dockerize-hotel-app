<?php
session_start();
function validateIn($str)
{
    $validIn = trim($str);
    return $validIn;
}
function validate_price($price)
{
    $valid_price = filter_var($price, FILTER_VALIDATE_FLOAT);
    if ($valid_price !== false) {
        $valid_price = floatval($valid_price); //get the value of $price as a float
    } else {
        $valid_price = null;
    } // Set $price to null if it's not a valid float
    return $valid_price;
}
$facilityName = validateIn($_POST['facilityName']);
$description = validateIn($_POST['description']);
$file = $_FILES['image'];
$caption = validateIn($_POST['imageCaption']);
$capacity = intval(validateIn($_POST['capacity']));
$price = validate_price(validateIn($_POST['price']));
$user = $_SESSION['username'];
$configuration = validateIn($_POST['bedConfiguration']);

include('incl/db_connect.inc');
function uploadType($facilityID)
{
    $facilityID = $_POST['facilityID'];
    if (isset($_POST['facilityID'])) { //if id is set, then it's an update
        $sql = "UPDATE facilities SET facilityname = ?, description = ?, caption = ?, capacity = ?, price = ?, configuration = ?, image = ?, username = ? WHERE facilityid = $facilityID";
    } else { //if id is not set, then it's an insert
        $sql = "INSERT INTO facilities (facilityname, description, caption, capacity, price, configuration, image, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    }
    return $sql;
}
function uploadNoImg($facilityID)
{
    if (isset($_POST['facilityID'])) { //if image is not set, continue to update the other fields
        $sql = "UPDATE facilities SET facilityname = ?, description = ?, caption = ?, capacity = ?, price = ?, configuration = ? WHERE facilityid = $facilityID";
    }
    return $sql;
}
if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $sql_valid = uploadType($_POST['facilityID']); //set sql query value
    $sepr = $connection->prepare($sql_valid);
    if ($sepr) {
        $sepr->bind_param("sssidsss", $facilityName, $description, $caption, $capacity, $price, $configuration, $file['name'], $user);
        $sepr->execute();
    } else {
        echo 'Error:' . mysqli_error($connection) . "\n";
    }
    if ($sepr->affected_rows > 0) {
        if (!empty($file)) {
            $tmp = $file['tmp_name'];
            $dest = "src/gallery/images/{$file['name']}"; // uploadedFiles is the folder name created in the current library folder
            if (is_dir(dirname($dest))) {
                $upload_success = move_uploaded_file($tmp, $dest);
                if ($upload_success) {
                    $_SESSION['usrmsg'] = "Item Uploaded Successfully. Check it out!";
                    echo '<script>window.location.href = "index.php";</script>';
                    exit(0);
                } else {
                    echo '<script>alert("Image Upload failed.\nCHECK FOLDER PERMISSIONS!");</script>';
                    $_SESSION['usrmsg'] = "Item Uploaded ERROR.";
                }
            } else {
                echo '<script>alert("directory unreachable");</script>';
            }
        }
    } else {
        echo '<script>alert("An error has occured\Check the code");</script>';
    }
} else {
    $sql_valid = uploadNoImg($_POST['facilityID']); //set sql query value
    $sepr = $connection->prepare($sql_valid);
    if ($sepr) {
        $sepr->bind_param("sssids", $facilityName, $description, $caption, $capacity, $price, $configuration);
        $sepr->execute();
    } else {
        echo 'Error:' . mysqli_error($connection) . "\n";
    }
    if ($sepr->affected_rows > 0) {
        $_SESSION['usrmsg'] = "Item Uploaded Successfully. Check it out!";
        echo '<script>window.location.href = "index.php";</script>';
        exit(0);
    } else {
        echo '<script>alert("Edit failed.\nCHECK SQL");</script>';
        $_SESSION['usrmsg'] = "ERROR: Could not edit that item";
    }
}

$sepr->close();
$connection->close();

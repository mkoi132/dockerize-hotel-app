<?php
$title = "User Collection";
include('incl/header.inc');
echo "\n<title>User Collection</title>\n";
print '<link rel="icon" href="src/gallery/collection.svg" type="image/svg+xml">';
include('incl/nav.inc');
//connect to db
include('incl/db_connect.inc');
$sqlquery = "SELECT * FROM facilities WHERE username = ?";
$stmt = $connection->prepare($sqlquery);
$stmt->bind_param("s", $_GET['username']);
$stmt->execute();
$record = $stmt->get_result();
//error handling
if (!$record) {
    die("Error in SQL db: " . mysqli_error($connection));
}
//retrive and bind data
$authorized = false; //handle user authoriation access
while ($row = $record->fetch_assoc()) {
    $facilityID = $row['facilityid'];
    $facilityName = $row['facilityname'];
    $image = $row['image'];
    $userdb = $row['username'];
    if (isset($_SESSION['username']) && $_SESSION['username'] == $userdb) {
        $authorized = true;
        break;
    }
}
//case if user is not authorized to edit content
if (!$authorized) {
    //redirect to login page with an error message
    //$message = "unauthorized&username=" . $_GET['username'];
    //header("Location:login.php?message=$message");
     echo "<script>
            window.location.href = 'login.php?message=unauthorized&username=" . urlencode($_GET['username']) . "';
          </script>";
    exit(); 
}
?>
<!-- page content -->
<main>
    <h1 class="text-center mt-5"><?php echo $_GET['username'] ?>'s Collection</h1>
    <div class="container mt-5">
        <div class='row g-4'>
            <div class='col-lg-4 col-md-6 col-sm-12'>
                <a href='facility_detail.php?id=<?php echo $facilityID ?>'>
                    <div class='card'>
                        <img src='src/gallery/images/<?php echo $image ?>' class="card-img-top img-fluid" alt='<?php echo $row['caption'] ?>'>
                        <div class=card-body>
                            <p class="card-text text-center fs-5"><?php echo $facilityName ?></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</main>
<?php
//close db
$connection->close();
include('incl/footer.inc');
?>
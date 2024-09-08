<?php
$title = "Home";
include('incl/header.inc');
echo "<title>Home Index</title>";
print '<link rel="icon" href="src/index/explore.svg" type="image/svg+xml">';
include('incl/nav.inc');
?>
<!-- get 4 latest images from db (image with 4 highest id) -->
<?php
//connect to db
include('incl/db_connect.inc');
$sqlquery = "SELECT * FROM facilities ORDER BY facilityid DESC LIMIT 4";
$record = $connection->query($sqlquery);
if (!$record) {
    die("Error in SQL query: " . mysqli_error($connection));
} else {
    while ($row = $record->fetch_assoc()) {
        $imagePath = $row['image']; // 'IMAGE' is the column with image paths
        $imagePaths[] = "src/gallery/images/{$imagePath}"; // make an array to store the paths for further uses
    }
}
//close db
$connection->close();
?>

<main>
    <?php
    if (isset($_GET['message']) && $_GET['message'] == 'logsuccess') { ?>
        <div class="alert alert-success alert-dismissible fade show mb-0">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Login Successful!</strong>
            <?php //handle access from modified url
            if($_SESSION['username']==""){
                $_SESSION['usrmsg'] = "Nice try! but Oops you still need to login.";
                echo "<script>
                window.location.href = 'index.php';
                </script>";}
            else{
                print "Welcome, " . $_SESSION['username'] . "!";
                unset($_SESSION['usrmsg']);} ?>
        </div>
<?php } //handle to display user message
    else if (isset($_SESSION['usrmsg'])) { ?>
        <div class="alert alert-warning alert-dismissible fade show mb-0">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?php print $_SESSION['usrmsg']; ?></strong>
            <?php unset($_SESSION['usrmsg']); ?>
        </div>
    <?php } ?>
    <div class="bg-secondary row pt-5 pb-5 contaianer">
        <div class="col-md-6 col-sm-12">
            <div id="slides" class="carousel slide mb-3 carousel-inner " data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#slides" data-bs-slide-to="0" class="active"></button>
                    <button type="button" data-bs-target="#slides" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#slides" data-bs-slide-to="2"></button>
                    <button type="button" data-bs-target="#slides" data-bs-slide-to="3"></button>
                </div>
                <!-- The slideshow -->
                <div class="carousel-inner bg-secondary">
                    <div class=" carousel-item active ">
                        <img src="<?php echo $imagePaths[0]; ?>" alt="facilities" class="d-block w-75 h-25 mx-auto img-fluid">
                    </div>
                    <div class=" carousel-item ">
                        <img src="<?php echo $imagePaths[1]; ?>" alt="facilities" class="d-block w-75 h-25 mx-auto img-fluid">
                    </div>
                    <div class="carousel-item ">
                        <img src="<?php echo $imagePaths[2]; ?>" alt="facilities" class="d-block w-75 h-25 mx-auto img-fluid">
                    </div>
                    <div class="carousel-item ">
                        <img src="<?php echo $imagePaths[3]; ?>" alt="facilities" class="d-block w-75 h-25 mx-auto img-fluid">
                    </div>

                    <!-- Left and right controls/icons -->

                    <button class="carousel-control-prev" type="button" data-bs-target="#slides" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slides" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <h1 class="ms-sm-6 slog1">INTERNATIONAL MELBOURNE HOTEL</h1>
            <H2 class="ms-sm-6 slog2">WELCOME TO MELBOURNE</H2>
        </div>
    </div>
    <div class="container">
        <div>
            <div class='text-center mt-4 mb-4'>
                <strong class="h3">DISCOVER MELBOURNE YOUR OWN WAY!</strong>
                <p>Located in the heart of Melbourne, close to all the major attractions. We offer a wide range of facilities and services to our guests.</p>
            </div>
        </div>
    </div>
</main>
<?php
include('incl/footer.inc');
?>
<?php
$title = "Facility Detail";
include('incl/header.inc');
echo "\n<title>Facility Details</title>\n";
print '<link rel="icon" href="src/facilities/spot.svg" type="image/svg+xml">';
include('incl/nav.inc');
?>

<main class="detail">
    <?php
    //connect to db
    include('incl/db_connect.inc');
    $facilityID = $_GET['id'];
    $sqlquery = "SELECT * FROM facilities WHERE facilityid = $facilityID";
    $record = $connection->query($sqlquery);
    if (!$record) {
        die("Error in SQL db: " . mysqli_error($connection));
    } else {
        while ($row = $record->fetch_assoc()) {
            $facilityID = $row['facilityid'];
            $facilityName = $row['facilityname'];
            $description = $row['description'];
            $image = $row['image'];
            $price = $row['price'];
            $capacity = $row['capacity'];
            $bedconfig = $row['configuration'];
            $author = $row['username'];
        }
    }
    if (isset($_SESSION['username']) && isset($_COOKIE['access_token']) && $_SESSION['access_token'] === $_COOKIE['access_token']) { ?>
        <div class="row mt-5 mx-auto container">
            <div class="text-center col-md-6 col-sm-12">
                <img src='src/gallery/images/<?php echo $image; ?>' class="img-fluid" alt='<?php echo $facilityName; ?>' height='280' width='400'>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="detail_title text-center text-md-start">
                    <h5 class="fw-bold h1"><?php echo $facilityName; ?></h5>
                    <p><?php echo $description; ?></p>
                </div>


                <div class=" mt-2 row me-auto ">
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <span class="material-symbols-outlined">paid</span>
                        <p> <?php echo ($price ? $price : 'POS'); ?> </p>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <span class="material-symbols-outlined">group</span>
                        <p><?php echo $capacity; ?></p>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <span class="material-symbols-outlined">bed</span>
                        <p><?php echo $bedconfig; ?></p>
                    </div>
                </div>
                <?php if (($_SESSION['username'] == $author)) { ?>
                    <button class="btn btn-warning w-25" onclick="location.href='edit.php?id=<?php echo $facilityID; ?>'">Edit</button>
                    <button class="btn btn-danger w-25" type="button" data-bs-toggle="modal" data-bs-target="#delConfirm">Delete</button>
                    <div id="delConfirm" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <strong class="modal-title text-danger text-xl">Confirm Deletion</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You are deleting facility named "<?php echo $facilityName ?>"</p>
                                    <p>If you wish to proceed, this action cannot be undone</p>
                                    <p class="text-danger">Do you wish to continue ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" onclick="location.href='process_delete.php?id=<?php echo $facilityID; ?>'">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else {
                    echo "<p class=mt-2>Log in as $author to edit or delete this facility</p>";
                } ?>

            </div>

        </div>
    <?php
    } else {
        $_SESSION['usrmsg'] = "Please LOGIN first to do that!";
        echo "<script>
            window.location.href = 'index.php';
          </script>";
    } ?>

</main>
<?php
//close db
$connection->close();
include('incl/footer.inc');
?>
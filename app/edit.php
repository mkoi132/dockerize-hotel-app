<?php
$title = "edit_FACILITIES";
include('incl/header.inc');
echo "<title>Edit Facility</title>";
print '<link rel="icon" href="src/add/dash_plus.svg" type="image/svg+xml">';
include('incl/nav.inc');
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
        $caption = $row['caption'];
    }
}
if (isset($_SESSION['username'])) { ?>
    <main class="container mt-5">
        <h1 class="h1 text-center">Edit Facility details</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="row">
            <div class="col-sm-12 col-md-6">
                <label for="facilityName" class="form-label">Facility Name: *</label>
                <input type="text" name="facilityName" id="facilityName" class="form-control" placeholder="Give your facility a name" value="<?php echo $facilityName ?>" required>
                <label for="description" class="form-label">Description: *</label>
                <textarea class="form-control" id="description" name="description" rows="6" placeholder="Good things about this facility" required><?php echo $description ?></textarea>
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="price" class="form-label">Price: *</label>
                <input class="form-control" type="text" id="price" name="price" placeholder="$0.00" value="<?php echo $price ?>" required>
                <label for="capacity" class="form-label">Capacity: *</label>
                <input class="form-control" type="number" id="capacity" name="capacity" placeholder="Max number of people" value="<?php echo $capacity ?>" required>
                <label for="bedConfiguration" class="form-label">Bed Configuration: *</label>
                <div>
                    <select id="bedConfiguration" name="bedConfiguration">
                        <option value="" disabled>----Select an option----</option>
                        <option value="1 Double" <?php echo ($bedconfig == '1 Double') ? 'selected' : "" ?>>1 Double</option> //php conditional statement to auto pick the current config from database
                        <option value="1 Queen" <?php echo ($bedconfig == '1 Queen') ? 'selected' : "" ?>>1 Queen</option>
                        <option value="1 King" <?php echo ($bedconfig == '1 King') ? 'selected' : "" ?>>1 King</option>
                        <option value="2 Single" <?php echo ($bedconfig == '2 Single') ? 'selected' : "" ?>>2 Single</option>
                        <option value="N/A" <?php echo ($bedconfig == 'N/A') ? 'selected' : "" ?>>Not Available</option>
                    </select>
                </div>
            </div>
            <div class="col-8 mt-3">
                <label for="image" class="form-label">Select an image (Max image size: 500MB): *</label>
                <input class="form-control form-control-file form-control-md" type="file" id="image" name="image" accept="image/*">
                <label for="imageCaption" class="form-label">Image caption: *</label>
                <input class="form-control" type="text" id="imageCaption" name="imageCaption" placeholder="Describe the image in one word" value="<?php echo $caption ?>" required><br>
                <p class="text-danger">Fields marked with * are required</p>
            </div>
            <input type="hidden" name="facilityID" id="facilityID" value="<?php echo $facilityID; ?>">
            <div class="summit_clear">
                <button type="submit" id="submit_btn">
                    <span class="material-symbols-outlined">add_task</span> &nbsp;
                    Submit
                </button>
                <button type="reset" id="clear_btn">
                    <span class="material-symbols-outlined">
                        backspace
                    </span> &nbsp;
                    Clear
                </button>
            </div>
        </form>
    </main>
<?php
} else {
    $_SESSION['usrmsg'] = "You can't bypass the LOGIN like that :)";
    header("Location:index.php?");
}
include('incl/footer.inc');
?>
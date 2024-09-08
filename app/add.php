<?php
$title = "FACILITIES_ADD";
include('incl/header.inc');
echo "<title>Add New Facility</title>";
print '<link rel="icon" href="/src/add/dash_plus.svg" type="image/svg+xml">';
include('incl/nav.inc');
if (isset($_SESSION['username']) && isset($_COOKIE['access_token']) && $_SESSION['access_token'] === $_COOKIE['access_token']) { ?>
    <main class="container mt-3">
        <h1 class="h1 text-center">Add a Facility</h1>
        <p class="text-center mt-1">You can add a new facility here.</p>
        <form action="upload.php" method="post" enctype="multipart/form-data" class="row">
            <div class="col-sm-12 col-md-6">
                <label for="facilityName" class="form-label">Facility Name: *</label>
                <input type="text" name="facilityName" id="facilityName" class="form-control" placeholder="Give your facility a name" required>
                <label for="description" class="form-label">Description: *</label>
                <textarea class="form-control" id="description" name="description" rows="6" placeholder="Good things about this facility" required></textarea>
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="price" class="form-label">Price: *</label>
                <input class="form-control" type="text" id="price" name="price" placeholder="$0.00" required>
                <label for="capacity" class="form-label">Capacity: *</label>
                <input class="form-control" type="number" id="capacity" name="capacity" placeholder="Max number of people" required>
                <label for="bedConfiguration" class="form-label">Bed Configuration: *</label>
                <div>
                    <select id="bedConfiguration" name="bedConfiguration" required>
                        <option value="" disabled selected>---Choose an option---</option>
                        <option value="1 Double">1 Double</option>
                        <option value="1 Queen">1 Queen</option>
                        <option value="1 King">1 King</option>
                        <option value="2 Single">2 Single</option>
                        <option value="N/A">Not Available</option>
                    </select>
                </div>
            </div>
            <div class="col-8 mt-3">
                <label for="image" class="form-label">Select an image (Max image size: 500MB): *</label>
                <input class="form-control form-control-file form-control-md" type="file" id="image" name="image" accept="image/*" required>
                <label for="imageCaption" class="form-label">Image caption: *</label>
                <input class="form-control" type="text" id="imageCaption" name="imageCaption" placeholder="Describe the image in one word" required><br>
                <p class="text-danger">Fields marked with * are required</p>
            </div>

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
    $_SESSION['usrmsg'] = "Uh..oh! Something went wrong, please login again!";
    header("Location:index.php?");
}
include('incl/footer.inc');
?>
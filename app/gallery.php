<?php
$title = "Gallery";
include('incl/header.inc');
echo "<title>Gallery</title>";
print '<link rel="icon" href="src/gallery/collection.svg" type="image/svg+xml">';
include('incl/nav.inc');
?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<main class=" container text-center">
    <h1 class="mt-4">Melbourne Has A Lot To Offer</h1>
    <p class="mt-1">AND WHAT BETTER WAY TO DISCOVER MELBOURNE ... YOUR OWN WAY. MELBOURNE INTERNATIONAL
        HOTEL CAN SERVE AS A PERFECT GATEWAY. WE CATER FOR EITHER PLEASURE OR BUSSINESS STAYS. <br> ARE YOU READY TO
        EXPLORE?</p>
    <div class="container  d-flex align-items-start">
        <div class="dropend">
            <button class="btn btn-dark dropdown-toggle me-auto" type="button" id="bedConfig" data-bs-toggle="dropdown" aria-expanded="false">
                Bed Configurations
            </button>
            <ul class="dropdown-menu" aria-labelledby="bedConfig">
                <li><a class="dropdown-item" href='#' data-bed-config="all">All Type</a></li>
                <li><a class="dropdown-item" href='#' data-bed-config="2 Single">Single Bed</a></li>
                <li><a class="dropdown-item" href='#' data-bed-config="1 Double">Double Bed</a></li>
                <li><a class="dropdown-item" href='#' data-bed-config="1 Queen">Queen Bed</a></li>
                <li><a class="dropdown-item" href='#' data-bed-config="1 King">King Bed</a></li>
                <li><a class="dropdown-item" href='#' data-bed-config="N/A">No Bed</a></li>
            </ul>
        </div>
    </div>

    <script src="navigation.js"></script>

    <div class="container card-contianer mt-3">
        <div class='row g-4'>
            <?php
            //connect to db
            include('incl/db_connect.inc');
            $sqlquery = "SELECT * FROM facilities";
            $record = $connection->query($sqlquery);
            if (!$record) {
                die("Error in SQL query: " . mysqli_error($connection));
            } else {
                while ($row = $record->fetch_assoc()) {
                    $imagePath = $row['IMAGE']; // Assuming 'IMAGE' is the column with image paths
                    $facilityID = $row['FACILITYID']; // Assuming 'FACILITYID' is the unique ID for each facility
                    $facilityName = $row['FACILITYNAME']; // Assuming 'FACILITYNAME' is the name of each facility
                    $caption = $row['CAPTION']; // Assuming 'CAPTION' is the caption for each image
                    echo "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>";
                    echo "<a href='facility_detail.php?id={$facilityID}'>";
                    echo "<div class='card item' data-bed-config='{$row['CONFIGURATION']}'>";
                    echo "<img src='src/gallery/images/{$imagePath}' class='card-img-top img-fluid' alt='{$row['CAPTION']}'>";
                    echo "<div class=card-body>";
                    echo "<p class='card-text text-center fs-6 text-truncate'>{$facilityName}</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>";
                    echo "</div>";
                }
            }
            //close db
            $connection->close();
            ?>
        </div>
    </div>
</main>
<?php
include('incl/footer.inc');
?>
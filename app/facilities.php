<?php
$title = "FACILITIES_VIEW";
include('incl/header.inc');
echo "<title>Facilities</title>";
print '<link rel="icon" href="src/facilities/spot.svg" type="image/svg+xml">';
include('incl/nav.inc');
$apikey = 'b6aaef5ademsh25f9a500529a7dfp14c293jsnf2b1b49735e0';
?>
<script src="imgload.js" async></script>

<main class=container>
    <div class="text-center mt-4 mb-5">
        <h1 class=h1>OUR BEST FACILITIES OFFERED</h1>
        <p class=mt-1>WE KNOW EVERYONE HAS ITS OWN STYLE AND FAVOURITE WAY TO SPEND THEIR LEASURE TIME. MELBOURNE INTENATONAL
            HOTEL
            HAS FACILITIES THAT WILL SASTIFY YOUR PERSONAL OR BUSSINESS NEEDS.</p>
        <p> <a href="gallery.php">LET'S HAVE A LOOK ▶</a></p>
    </div>
    <div class="row ">

        <img src="src/facilities/southgatetowilliamstownferry.jpeg" id="demofac" class="col-md-5 me-4 col-sm-12" alt="Melbourne Hotel" width="400" height="300">

        <div class='col-md-6 col-sm-12'>
            <div class=table-responsive>
                <table class="table table-hover">
                    <thead>
                        <tr class=table-active>
                            <th>Facility Type</th>
                            <th>Capacity</th>
                            <th>Bed Configuration</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //connect to db
                        include('incl/db_connect.inc');
                        $sqlquery = "SELECT * FROM facilities";
                        $record = $connection->query($sqlquery);
                        if (!$record) {
                            die("Error in SQL query: " . mysqli_error($connection));
                        } else {
                            while ($row = $record->fetch_array()) {
                                echo "<tr>";
                                echo "<td><a href='facility_detail.php?id={$row['facilityid']}'> {$row['facilityname']}</a></td>";
                                echo "<td>" . $row['capacity'] . "</td>";
                                echo "<td>" . $row['configuration'] . "</td>";
                                if (is_null($row['price'])) {
                                    echo "<td>POS</td>";
                                } else {
                                    echo "<td>" . $row['price'] . "</td>";
                                }
                                echo "</tr>";
                            }
                        }
                        //close db
                        $connection->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
<?php
include('incl/footer.inc');
?>
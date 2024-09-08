<?php
include('incl/db_connect.inc');
$sqlf = "SELECT DISTINCT username FROM facilities";
$record = $connection->query($sqlf);
if (!$record) {
    die("Error in SQL query: " . mysqli_error($connection));
} else {
    while ($row = $record->fetch_assoc()) {
        $registeredUsers[] = "{$row['username']}"; // make an array to store the username for further uses
    }
}
?>
<footer class="page-footer font-small">
    <p class='text-center'></p>
    <div class='text-center pb-3 fs-6'>
        <?php echo "User Collections: ";
        if (!empty($registeredUsers)) {
        foreach ($registeredUsers as $user) {
            echo " <a href=\"user_collection.php?username=$user\" class=\"text-dark\">$user</a>
        ";
        }}else {
            // If no users are found, display a message
            echo "<p>There is no collection. Login and add something!</p>";
        }
         ?>
    </div>
    <div class="footer-copyright text-center pb-5">
        &copy; COPYRIGHT MINH KHOI NGUYEN | DESINGED FOR INTERNATIONAL MELBOURNE HOTEL
        <p>Disclaimer: This website is designed for educational purposes only, its notional contents do not represent any legitimate entity, place, or organisation.</p>
    </div>
</footer>
</body>

</html>
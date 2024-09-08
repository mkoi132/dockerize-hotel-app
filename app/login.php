<?php
$title = "login";
include('incl/header.inc');
echo "<title>Login</title>";
print '<link rel="icon" href="src/index/explore.svg" type="image/svg+xml">';
include('incl/nav.inc');

?>
<div class="container col-md-8">
    <?php
    if (isset($_GET['message'])) {
        if ($_GET['message'] == 'regsuccess') {
            echo '<p class="mt-5 text-success fw-bold">You have successfully registered. Login now!</p>';
        } else if ($_GET['message'] == 'logerror') {
            echo '<p class="mt-5 text-danger fw-bold"> An error occured, ensure correct user name and password. OR you have not yet registered.</p>';
        } else if (isset($_SESSION['username']) && $_GET['message'] == 'unauthorized') {
            $curUser = $_SESSION['username'];
            $orauthor = $_GET['username'];
            echo "<p class=\"mt-5 text-danger fw-bold\">Hi $curUser. Seems that you DO NOT have the authority to view $orauthor's collection. Login as '$orauthor' fisrt.</p>";
        } else if ($_GET['message'] == 'unauthorized') {
            $orauthor = $_GET['username'];
            echo "<p class=\"mt-5 text-danger fw-bold\">Unauthorized access: Login as '$orauthor' to view this collection </p>";
        }
    }
    ?>
    <h1 class="mt-5">Login to your account</h1>
    <form action="process_login.php" method="post">
        <div class="mb-3 mt-5">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control-lg" required>
        </div>
        <div class="mb-5">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control-lg ms-1" required>
            <input type="submit" value="Login" class="btn btn-primary ms-3">
        </div>
        <div class="mb-5">
            <a href="register.php" class="me-3">New? Register</a>
        </div>
    </form>
</div>
<?php
include('incl/footer.inc');
?>
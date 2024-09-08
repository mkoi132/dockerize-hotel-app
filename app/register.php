<?php
$title = "register";
include('incl/header.inc');
echo "<title>Register</title>";
print '<link rel="icon" href="src/index/explore.svg" type="image/svg+xml">';
include('incl/nav.inc');

?>
<div class="container container col-md-8">
    <?php
    if (isset($_GET['message']) && $_GET['message'] == 'regerror') {
        echo '<p class="mt-5 text-danger fw-bold"> An error occured, Register again!</p>';
    }
    ?>
    <h1 class="mt-5"> Register new user</h1>
    <form action="process_register.php" method="post">
        <div class="mb-3 mt-5">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control-lg" required>
        </div>
        <div class="mb-5">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control-lg ms-1" required>
            <input type="submit" class="btn btn-primary ms-3" value="Register">
        </div>
        <div class="mb-5">
            <a href="login.php" class="me-3">Login instead?</a>
        </div>
    </form>
</div>
<?php
include('incl/footer.inc');
?>
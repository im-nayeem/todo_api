<?php 
    require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/login-filter.php';

    if(!isset($_SESSION['user']))
        LoginFilter::forceLogin();
?>

<div class="container mt-5">
    <h2>Profile</h2>
    <div>
        <p><strong>Name:</strong> <?php echo $_SESSION['user']['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['user']['email']; ?></p>
    </div>
    <a href="/account/user.php?t=logout" class="btn btn-primary">Logout</a>
</div>

<?php require_once $_SERVER["DOCUMENT_ROOT"].'/includes/footer.php';?>

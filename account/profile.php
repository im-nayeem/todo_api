<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php';
?>

<div class="container mt-4">
    <h2>Profile</h2>
    <div>
        <p><strong>Name:</strong> <?php echo $_SESSION['user']['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['user']['email']; ?></p>
    </div>
    <a href="/account/" class="btn btn-danger">Logout</button>
</div>
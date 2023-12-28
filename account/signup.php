<?php 
    require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php'; 

    if(LoginFilter::isLoggedIn())
    {
        header('Location: /account/profile.php');
    }
?>
    <!-- Content: Sign Up Form -->
    <div class="container mt-4">
        <h2>Sign Up</h2>
        <p style="color:red;"><?php if(isset($_REQUEST['msg'])) echo $_REQUEST['error_msg'];?></p>
        
        <form method="POST" action="/account/create-user.php">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password(length must be at least 8 character)" pattern=".{8,}" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>

    <script src="/includes/password-checker.js"></script>

</body>
</html>

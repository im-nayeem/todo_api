<?php 
    require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php'; 
?>

<!-- Content: Sign In Form -->
    <div class="container mt-4">
        <h2>Reset Password</h2>
        <p style="color:red;"><?php if(isset($_REQUEST['error_msg'])) echo $_REQUEST['error_msg'];?></p>
        <p style="color:green;"><?php if(isset($_REQUEST['msg'])) echo $_REQUEST['msg'];?></p>
       
        <form method="GET" action="/account/user.php">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="text"  name="t" value="reset_password" hidden>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>
</html>

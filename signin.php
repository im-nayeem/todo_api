<?php require_once $_SERVER["DOCUMENT_ROOT"].'/includes/header.php'; ?>

<!-- Content: Sign In Form -->
    <div class="container mt-4">
        <h2>Sign In</h2>
        <p style="color:green;"><?php if(isset($_REQUEST['msg'])) echo $_REQUEST['msg'];?></p>
        <form method="POST" action="/authentication.php">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
    </div>

</body>
</html>

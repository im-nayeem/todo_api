<?php require_once $_SERVER["DOCUMENT_ROOT"].'/login-filter.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToDo Manager</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Left Side: Home and About Buttons -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
        </ul>

        <!-- Right Side: Sign In and Sign Up Buttons -->
        <?php if(!isset($_SESSION['user'])):?> 
            <ul class="navbar-nav ml-auto" id="signBtn">
                <li class="nav-item">
                    <a class="nav-link" href="/account/signin.php">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/account/signup.php">Sign Up</a>
                </li>
            </ul>
        <?php else:?>
            <ul class="navbar-nav ml-auto" id="profile">
                <li class="nav-item">
                    <a class="nav-link" href="/account/profile.php"><i class="fa fa-user"></i> Profile</a>
                </li>
            </ul>
        <?php endif;?>
    </div>
</nav>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToDo Manager</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- Left Side: Home and About Buttons -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="./">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
        </ul>

        <!-- Right Side: Sign In and Sign Up Buttons -->
        <ul class="navbar-nav ml-auto" id="signBtn">
            <li class="nav-item">
                <a class="nav-link" href="./signin.php">Sign In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./signup.php">Sign Up</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto" id="profile" style="display: none;">
            <li class="nav-item">
                <a class="nav-link" href="#">Profile</a>
            </li>
        </ul>
    </div>
</nav>
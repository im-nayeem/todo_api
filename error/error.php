<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #e74c3c;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #333;
        }
        a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }
        a:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Oops! An Error Has Occured.</h2>
        <p><?=$_REQUEST['error_msg'];?></p>
        <p>Return to <a href="/">home</a>.</p>
    </div>
</body>
</html>
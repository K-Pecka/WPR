<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <style>
        body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .error-container {
            text-align: center;
            margin: 150px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }

        .error-icon {
            margin-bottom: 30px;
        }

        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #777;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff3366;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e60052;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-icon">
            <img src="error-icon.png" alt="Error Icon">
        </div>
        <h1>Oops!</h1>
        <p>Something went wrong.</p>
        <p>Please try again later.</p>
        <a href="index.php" class="btn">Go back to Home</a>
    </div>
</body>

</html>
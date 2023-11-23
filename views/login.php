<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit User Data</title>
</head>
<body>

<form action="../controllers/auth/login.php" method="post">
    <label for="userName">Username:</label>
    <input type="text" id="userName" name="userName" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <button type="submit">Submit</button>
</form>

</body>
</html>

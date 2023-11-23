<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit User Data</title>
</head>
<body>

<form action="../controllers/auth/register.php" method="post">
    <label for="userName">Username:</label>
    <input type="text" id="userName" name="userName" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required><br>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br>

    <label for="gender">Gender:</label>
    <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select><br>

    <label for="birthDate">Birth Date:</label>
    <input type="date" id="birthDate" name="birthDate" required><br>

    <label for="salary">Salary:</label>
    <input type="text" id="salary" name="salary" required><br>

    <label for="gender">Role:</label>
    <select id="gender" name="role" required>
        <option value="admin">admin</option>
        <option value="sitter">sitter</option>
        <option value="kid">kid</option>
    </select><br>

    <label for="gender">level:</label>
    <select id="gender" name="level" required>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>

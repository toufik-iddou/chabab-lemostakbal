<?php
require_once '../models/classroom.php';
require_once '../utils/enums.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit User Data</title>
</head>

<body>

    <form action="../controllers/auth/register.php" method="post" enctype="multipart/form-data">
        <label for="id">id</label>
        <input type="text" id="id" name="id" required><br>

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


        <label for="gender">gender:</label>
        <select id="gender" name="gender" required>
            <?php
            $genders = Gender::values;
            foreach ($genders as $gender) {
                echo '<option value="' . $gender . '">' . $gender . '</option>';
            }

            ?>
        </select><br>

        <label for="birthDate">Birth Date:</label>
        <input type="date" id="birthDate" name="birthDate" required><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required><br>

        <label for="salary">Salary:</label>
        <input type="text" id="salary" name="salary" required><br>


        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <?php
            $roles = Role::values;
            foreach ($roles as $role) {
                echo '<option value="' . $role . '">' . $role . '</option>';
            }

            ?>
        </select><br>





        <label for="classroom">classrooms:</label>
        <select id="classroom" name="classroom" required>
            <?php
            $classrooms = Classroom::findWhere('1');
            foreach ($classrooms as $classroom) {
                echo '<option value="' . $classroom->getId() . '">' . $classroom->getName() . '</option>';
            }

            ?>
        </select><br>

       

        <label for="file">Choose a file:</label>
        <input type="file" name="file" id="file">
        <br>
---------------------Parent INFO-----------------------------------------
<br>
<label for="p-firstName">First Name:</label>
        <input type="text" id="p-firstName" name="p-firstName" required><br>

        <label for="p-lastName">Last Name:</label>
        <input type="text" id="p-lastName" name="p-lastName" required><br>

        <label for="p-address">Address:</label>
        <input type="text" id="p-address" name="p-address" required><br>


        <label for="p-gender">gender:</label>
        <select id="p-gender" name="p-gender" required>
            <?php
            $genders = Gender::values;
            foreach ($genders as $gender) {
                echo '<option value="' . $gender . '">' . $gender . '</option>';
            }

            ?>
        </select><br>

        <label for="p-email">Email:</label>
        <input type="text" id="p-email" name="p-email" required><br>

        <label for="p-phone">Phone:</label>
        <input type="text" id="p-phone" name="p-phone" required><br>



        <button type="submit">Submit</button>
    </form>

</body>

</html>
<?php
require_once  '../models/sitter.php';
require_once  '../utils/enums.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit User Data</title>
</head>
<body>

<form action="../controllers/classroom.php" method="post">
    <label for="name">name:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="sitter">sitters:</label>
    <select id="sitter" name="sitter" required>
    <?php
        $sitters = Sitter::findWhere('1');
        foreach ($sitters as  $sitter) {
            echo '<option value="'.$sitter->getId().'">'.$sitter->getFirstName().' '.$sitter->getLastName() .'</option>';
            }
            
        ?>
    </select><br>
   
    <label for="level">level:</label>
    <select id="level" name="level" required>
    <?php
         $levels = KidLevel::values;
        foreach ( $levels as  $level) {
            echo '<option value="'.$level.'">'.$level .'</option>';
            }
            
        ?>
    </select><br>
   
    <button type="submit">Submit</button>
</form>

</body>
</html>

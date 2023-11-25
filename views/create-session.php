<?php
require_once  '../models/classroom.php';
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

<form action="../controllers/session.php" method="post">
    

    <label for="classroom">classrooms:</label>
    <select id="classroom" name="classroom" required>
    <?php
        $classrooms = Classroom::findWhere('1');
        foreach ($classrooms as  $classroom) {
            echo '<option value="'.$classroom->getId().'">'.$classroom->getName().'</option>';
            }
            
        ?>
    </select><br>
   
    <label for="activity">activity:</label>
    <select id="activity" name="activity" required>
    <?php
         $activities = Activity::values;
        foreach ( $activities as  $activity) {
            echo '<option value="'.$activity.'">'.$activity .'</option>';
            }
            
        ?>
</select><br>
    <label for="day">day:</label>
    <select id="day" name="day" required>
    <?php
         $days = Day::values;
        foreach ( $days as  $day) {
            echo '<option value="'.$day.'">'.$day .'</option>';
            }
            
        ?>
    </select><br>

    <label for="start-at">start at:</label>
    <input type="time" id="start-at" name="start-at" required><br>
    <label for="end-at">end at:</label>
    <input type="time" id="end-at" name="end-at" required><br>


   
    <button type="submit">Submit</button>
</form>

</body>
</html>

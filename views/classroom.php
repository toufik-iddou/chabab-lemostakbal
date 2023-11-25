<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit User Data</title>
</head>
<body>

    


    <?php
    require __DIR__ . '/../utils/db-requests.php';
        $classrooms = Select_query("SELECT classrooms.id AS classroom_id, classrooms.name AS classroom_name , classrooms.level, sitters.id AS sitter_id, sitters.firstName , sitters.lastName , COUNT(kids.id) AS num_kids FROM classrooms JOIN sitters ON classrooms.sitter = sitters.id LEFT JOIN kids ON classrooms.id = kids.classroom GROUP BY classrooms.id, sitters.id;");
        foreach ($classrooms as  $classroom) {
            echo '<div>'.$classroom["classroom_id"].' | '.$classroom["classroom_name"].' | '.$classroom["level"].' | '.$classroom["firstName"].' '.$classroom["lastName"].' | '.''.$classroom["num_kids"].' | '.''.'</div><br>';
            }
            
        ?>
   

</body>
</html>

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
        $sessions = Select_query("select sessions.id ,activity,start_at,end_at,day,sitters.firstName,sitters.lastName,classrooms.level from sessions ,sitters,classrooms where classrooms.sitter=sitters.id and classrooms.id=sessions.classroom;");
        foreach ($sessions as  $session) {
            echo '<div>'.$session["id"].' | '
            .$session["firstName"].' '.$session["lastName"].' | '
            .$session["activity"].' | '
            .$session["day"].' | '
            .$session["start_at"].' | '
            .$session["end_at"].' | '
            .''.$session["level"].' | '.'</div><br>';
            }
            
        ?>
   

</body>
</html>

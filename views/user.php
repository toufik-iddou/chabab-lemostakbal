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
        $users = Select_query("SELECT kids.id ,credentialId ,role, firstName,lastName, image FROM kids JOIN credentials on credentials.id=credentialId
        UNION
        SELECT admins.id ,credentialId ,role, firstName,lastName, image FROM admins JOIN credentials on credentials.id=credentialId
        UNION
        SELECT sitters.id ,credentialId ,role, firstName,lastName, image FROM sitters JOIN credentials on credentials.id=credentialId
         ");
        foreach ($users as  $user) {
            echo '<div>'.$user["id"].' | '.$user["credentialId"].' | '.$user["role"].' | '.$user["firstName"].' '.$user["lastName"].' | '.$user["image"].'</div><br>';
            }
            
        ?>
   

</body>
</html>

<?php

if (isset($_COOKIE['role'])) {
    $cookieRole = $_COOKIE['role'];
} else {
    header('Location: ' . "./index.html");
            exit;
}
?>
<?php
                        
    require __DIR__ . '/../utils/db-requests.php';
    require_once __DIR__ . '/../utils/statics.php';
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Members</title>
</head>

<body>
    <div class="wrapper d-flex">
        <div class="sidebar">

            <div class="profile">
                <a href="#"><i class="far fa-user-circle"></i></a>
                <p class="username">Admin<br><a href="#" class="view">View Info</a></p>
                <a href="#"><i class="fas fa-cog"></i></a>
            </div>

            <div class="menu-contain">
                <p class="header">Menu</p>
                <ul>
<?php
                if($cookieRole=="admin"){
                    echo '<li class="active"><a href="./members.php"><i class="fas fa-users"></i>Members</a></li>';
                }                
?>
                    <li><a href="./classes.php"><i class="fas fa-calendar-week"></i>Classes</a></li>
                    <li><a href="./classes.php"><i class="far fa-envelope"></i>Messages</a></li>
                    <li><a href="./sessions.php"><i class="fa-solid fa-swatchbook"></i>Sessions</a></li>
                    <li><a href="./presence.php"><i class="fa-solid fa-clock"></i>Presence</a></li>
                </ul>
            </div>
            <div class="menu-contain">
                <p class="myproject px-3">General</p>
                <ul>
                    <li><a href="#"><i class="fas fa-cog"></i>Settings</a></li>
                    <li><a href="#"><i class="fa-solid fa-comments"></i>FeedBack</a></li>
                    <li><a href="#"><i class="fa-solid fa-circle-question"></i>Helpdesk</a></li>
                </ul>
            </div>
            <h1>ShababElMostakbil</h1>
        </div>
        <div class="content">
            <div class="title">
                <h1>Members</h1>
                <?php
                 $counters = Select_query("SELECT 'admins' AS user_type, COUNT(*) AS count FROM admins
                 UNION
                 SELECT 'sitters' AS user_type, COUNT(*) AS count FROM sitters
                 UNION
                 SELECT 'kids' AS user_type, COUNT(*) AS count FROM kids;");
                ?>

                <i class="fas fa-cog"></i>

            </div>
            <div class="stats">
                <div class="box">
                    <i class="fa-solid fa-children"></i>
                    <H2>
                        <?php
                        echo $counters[0]["count"];
                        ?>
                    </H2>
                    <p>Childrens</p>
                </div>
                <div class="box">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    <H2>
                    <?php
                        echo $counters[1]["count"];
                        ?>
                    </H2>
                    <p>Sitters</p>
                </div>
                <div class="box">
                    <i class="fa-solid fa-user-secret"></i>
                    <H2>
                    <?php
                        echo $counters[2]["count"];
                        ?>
                    </H2>
                    <p>Admins</p>
                </div>
            </div>
            <div class="persons-list">
                <div class="details">
                    <p>Total (<span>    <?php
                        echo $counters[0]["count"]+$counters[1]["count"]+$counters[2]["count"];
                        ?> </span>)</p>

                    <div class="search">
                        <form action="">
                            <input type="text" placeholder="Search ...">
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>

                        </form>
                    </div>
                    <a href="add-person.php">+</a>

                </div>
                <div class="table">
                    <table>
                        <tr>
                            <th class="id">id</th>
                            <th class="image">image</th>
                            <th class="name">Name</th>
                            <th class="role">role</th>

                            <th class="info">info</th>
                            <th class="remove">Remove</th>
                        </tr>

                        <?php
        $users = Select_query("SELECT kids.id ,credentialId ,role, firstName,lastName, image FROM kids JOIN credentials on credentials.id=credentialId
        UNION
        SELECT admins.id ,credentialId ,role, firstName,lastName, image FROM admins JOIN credentials on credentials.id=credentialId
        UNION
        SELECT sitters.id ,credentialId ,role, firstName,lastName, image FROM sitters JOIN credentials on credentials.id=credentialId
         ");
        foreach ($users as  $user) {
           echo '<tr class="card">
            <td class="id">'.$user["credentialId"].' </td>
            <td class="image"><img src="'.$imagesPath.'/'.$user["image"].'" alt=""></td>
            <td class="name">'.$user["firstName"].' '.$user["lastName"].'</td>
            <td class="role">'.$user["role"].' </td>

            <td class="info"><i class="fa-solid fa-circle-info"></i></td>
            <td class="remove"><i class="fa-solid fa-trash"></i></td>
        </tr>';
            }
            
        ?>



                        
                  
                       
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
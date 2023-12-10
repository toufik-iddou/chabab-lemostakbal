<?php
require  'midelware.php';
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
    <title>Presence</title>
</head>

<body>
    <div class="wrapper d-flex">
        <div class="sidebar">

            <div class="profile">
                <a href="#"><i class="far fa-user-circle"></i></a>
                <p class="username"><?php echo $cookieUserName ?><br><a href="#" class="view">View Info</a></p>
                <a href="#"><i class="fas fa-cog"></i></a>
            </div>

            <div class="menu-contain">
                <p class="header">Menu</p>
                <ul><?php
                if($cookieRole=="admin"){
                    echo '<li><a href="./members.php"><i class="fas fa-users"></i>Members</a></li>';
                }   ?>
                <li><a href="./classes.php"><i class="fas fa-calendar-week"></i>Classes</a></li>
                    <li><a href="./classes.php"><i class="far fa-envelope"></i>Messages</a></li>
                    <li><a href="./sessions.php"><i class="fa-solid fa-swatchbook"></i>Sessions</a></li>
                    <?php
                    if($cookieRole=="admin"){
                    echo ' <li  class="active"><a href="./presence.php"><i class="fa-solid fa-clock"></i>Presence</a></li>';
                }   ?>
                 
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
                <h1>Presence:</h1>
                <i class="fas fa-cog"></i>
            </div>
            <div class="persons-list presence">
                <div class="details">
                    <p>Total (<span> 10 </span>)</p>

                    <div class="search">
                        <form action="">
                            <input type="text" placeholder="Search ...">
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>

                        </form>
                    </div>
                </div>
                <div class="table presence">
                    <table>
                        <tr>
                            <th class="id">Id</th>
                            <th class="image">Image</th>
                            <th class="name">Name</th>
                            <th class="role">role</th>
                            <th class="class">Date</th>
                            <th class="start-time">Enter Time</th>
                        </tr>

                        <?php
                         require __DIR__ . '/../utils/db-requests.php';
                         require_once __DIR__ . '/../utils/statics.php';
                        $pointings = Select_query("SELECT pointings.id,credentialId,image,pointings.created_at,role,firstName,lastName from pointings,credentials,kids where credentialId=credentials.id and pointings.user=credentialId UNION 
                        SELECT pointings.id,credentialId,image,pointings.created_at,role,firstName,lastName from pointings,credentials,admins where credentialId=credentials.id and pointings.user=credentialId UNION 
                        SELECT pointings.id,credentialId,image,pointings.created_at,role,firstName,lastName from pointings,credentials,sitters where credentialId=credentials.id and pointings.user=credentialId;");
                        foreach ($pointings as $pointing) {
                            $datetimeString = $pointing["created_at"];

                            $datetime = new DateTime($datetimeString);
                            $date = $datetime->format('Y-m-d');
                            $time = $datetime->format('H:i');
                            echo '
                            <tr class="card">
                                <td class="id">' . $pointing["credentialId"] . '</td>
                                <td class="image"><img src="'.$imagesPath.'/'.$pointing["image"].'" alt=""></td>
                                <td class="name">' . $pointing["firstName"] . ' ' . $pointing["lastName"] . '</td>
                                <td class="role">' . $pointing["role"] . '</td>
                                <td class="date">'.$date.'</td>
                                <td class="start-time">'.$time.'</td>
                            </tr>
                            ';
                        }
                        ?>




                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
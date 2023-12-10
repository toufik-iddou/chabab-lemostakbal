
<?php
require_once  '../models/classroom.php';
require_once  '../utils/enums.php';
require __DIR__ . '/../utils/db-requests.php';
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
        <title>Sessions</title>
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
                        <li class="active"><a href="./sessions.php"><i class="fa-solid fa-swatchbook"></i>Sessions</a></li>
                        <?php
                if($cookieRole=="admin"){
                    echo ' <li><a href="./presence.php"><i class="fa-solid fa-clock"></i>Presence</a></li>';
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
                    <h1>Sessions</h1>

                    <i class="fas fa-cog"></i>

                </div>
                <div class="create">
                    <h1>Create New Session:</h1>
                    <form action="../controllers/session.php" method="post">
                        
                        <div class="options">
                            <label for="classroom">Classroom:</label>
                            <select id="classroom" name="classroom">
                            <?php
        $classrooms = Classroom::findWhere('1');
        foreach ($classrooms as  $classroom) {
            echo '<option value="'.$classroom->getId().'">'.$classroom->getName().'</option>';
            }
            
        ?>
                            </select>
                        </div>
                        <div class="options">
                            <label for="activity">Activity:</label>
                            <select id="activity" name="activity">
                            <?php
         $activities = Activity::values;
        foreach ( $activities as  $activity) {
            echo '<option value="'.$activity.'">'.$activity .'</option>';
            }
            
        ?>
                            </select>
                        </div>

                        <div class="options">
                            <label for="day">Day:</label>
                            <select id="day" name="day">
                            <?php
         $days = Day::values;
        foreach ( $days as  $day) {
            echo '<option value="'.$day.'">'.$day .'</option>';
            }
            
        ?>
                            </select>
                        </div>
                        <div class="input-date">
                            <label for="start-at">Start Time:</label>
                            <input type="time" id="start-at" name="start-at" min="08:00" max="18:00" />
                        </div>
                        <div class="input-date">
                            <label for="end-at">End Time:</label>
                            <input type="time" id="end-at" name="end-at" min="08:00" max="18:00" />
                        </div>

                        <button class="add-session">Add Session</button>
                    </form>


                </div>
                <div class="persons-list sessions">
                    <div class="details">

                        <p>Total (<span>
                    <?php
                       $sessions = Select_query("select sessions.id ,name,activity,start_at,end_at,day,sitters.firstName,sitters.lastName,classrooms.level from sessions ,sitters,classrooms where classrooms.sitter=sitters.id and classrooms.id=sessions.classroom;");
                    echo count($sessions)
                    ?>        
                        
                    
                    </span>)</p>

                        <div class="search">
                            <form action="">
                                <input type="text" placeholder="Search ...">
                                <button><i class="fa-solid fa-magnifying-glass"></i></button>

                            </form>
                        </div>


                    </div>
                    <div class="table">
                        <table class="sessions-table">
                            
                            <tr>
                                <th class="id">id</th>
                                <th class="sitter">Sitter</th>
                                <th class="activity">Activity</th>
                                <th class="level">Level</th>
                                <th class="status">Classroom</th>
                                <th class="day">Day</th>
                                <th class="start">StartAt</th>
                                <th class="end">EndtAt</th>
                            </tr>

                            <?php

                             
                                foreach ($sessions as  $session) {
                                    
$startTime = DateTime::createFromFormat('H:i:s', $session["start_at"]);
$endTime = DateTime::createFromFormat('H:i:s', $session["end_at"]);
$formattedStartTime = $startTime->format('H:i');
$formattedEndTime = $endTime->format('H:i');

echo'
<tr class="card">
<td class="id">'.$session["id"].'</td>
<td class="sitter">'.$session["firstName"].' '.$session["lastName"].'</td>
<td class="activity">'.$session["activity"].'</td>
<td class="level">'.$session["level"].' </td>
<td class="classroom">'.$session["name"].'</td>
<td class="day">'.$session["day"].'</td>
<td class="start">'.$formattedStartTime.'</td>
<td class="end">'.$formattedEndTime.'</td>
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

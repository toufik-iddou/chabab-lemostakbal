
<?php
require  'midelware.php';
require_once  '../models/sitter.php';
require_once  '../utils/enums.php';
require __DIR__ . '/../utils/db-requests.php';
require __DIR__ . '/../utils/statics.php';
  
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
    <title>Classes</title>
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
                <ul>
                <?php
                if($cookieRole=="admin"){
                    echo '<li ><a href="./members.php"><i class="fas fa-users"></i>Members</a></li>';
                }
                ?>
                <li class="active"><a href="./classes.php"><i class="fas fa-calendar-week"></i>Classes</a></li>
                    <li><a href="./classes.php"><i class="far fa-envelope"></i>Messages</a></li>
                    <li><a href="./sessions.php"><i class="fa-solid fa-swatchbook"></i>Sessions</a></li>
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
                <h1>Classes</h1>
                <i class="fas fa-cog"></i>
            </div>
            <div class="create classroom">
                <h1>Create New Classroom:</h1>
                <form action="../controllers/classroom.php" method="post">
                <div class="input-field">
                                    <label for="name">Class Name:</label><br>
                                    <input type="text" id="name" name="name" placeholder="Ex : Nousour" required><br>
                                </div>

                    <div class="options">
                        <label for="sitter">Sitter:</label>
                        <select id="sitter" name="sitter">
                        <?php
                        $sitters = Sitter::findWhere('1');
                        foreach ($sitters as  $sitter) {
                            echo '<option value="'.$sitter->getId().'">'.$sitter->getFirstName().' '.$sitter->getLastName() .'</option>';
                            }
                            
                        ?>
                        </select>
                    </div>

                    <div class="options">
                        <label for="level">Level:</label>
                        <select id="level" name="level">
                        <?php
         $levels = KidLevel::values;
        foreach ( $levels as  $level) {
            echo '<option value="'.$level.'">'.$level .'</option>';
            }
            
        ?>
                        </select>
                    </div>
                    <button class="add-classroom">Add Classroom</button>
                </form>
            </div>
            <div class="persons-list sessions classroom-list">
                <div class="details">
                    <p>Total (<span> 
                <?php
                $classrooms = Select_query("SELECT classrooms.id AS classroom_id, classrooms.name AS classroom_name , classrooms.level,sitters.image, sitters.id AS sitter_id, sitters.firstName , sitters.lastName , COUNT(kids.id) AS num_kids FROM classrooms JOIN sitters ON classrooms.sitter = sitters.id LEFT JOIN kids ON classrooms.id = kids.classroom GROUP BY classrooms.id, sitters.id;");
                    echo count($classrooms);
                ?>        
                 </span>)</p>
                    <div class="search">
                        <form action="">
                            <input type="text" placeholder="Search ...">
                            <button><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
                <div class="classes-container">


                    <?php
                        foreach ($classrooms as  $classroom) {

echo '
<div class="class-card">
                        <h1>'.$classroom["classroom_name"].'</h1>
                        <div class="sitter"><img src="'.$imagesPath.'/'.$classroom["image"].'" alt="">
                            <p>'.$classroom["firstName"].' '.$classroom["lastName"].'</p>
                        </div>
                        <div class="level">
                            <p>Level :</p>
                            <p class="class-level">'.$classroom["level"].' </p>
                        </div>
                        <div class="info">
                            <p><span id="kids-number">'.$classroom["num_kids"].'</span> Kids</p><button><i
                                    class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    ';
                        }   
                        ?>
                   
                

                    
                    
                
                </div>
            </div>
        </div>
    </div>

</body>

</html>
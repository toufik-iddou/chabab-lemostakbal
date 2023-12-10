<?php
function sidebar($index){
if (isset($_COOKIE['role'])) {
    $cookieRole = $_COOKIE['role'];
    $cookieUserName = $_COOKIE['userName'];
} else {
    header('Location: ' . "./index.html");
            exit;
}

echo'
<div class="sidebar">

<div class="profile">
    <a href="#"><i class="far fa-user-circle"></i></a>
    <p class="username">'.$cookieUserName.'<br><a href="#" class="view">View Info</a></p>
    <a href="#"><i class="fas fa-cog"></i></a>
</div>

<div class="menu-contain">
    <p class="header">Menu</p>
    <ul>

    '.$cookieRole=="admin"?
    '<li '.$index==0?'class="active"':''.' ><a href="./members.php"><i class="fas fa-users"></i>Members</a></li>':''
                    
    .'<li '.$index==1?'class="active"':''.'><a href="./classes.php"><i class="fas fa-calendar-week"></i>Classes</a></li>
        <li '.$index==2?'class="active"':''.'><a href="./classes.php"><i class="far fa-envelope"></i>Messages</a></li>
        <li '.$index==3?'class="active"':''.'><a href="./sessions.php"><i class="fa-solid fa-swatchbook"></i>Sessions</a></li>
        <li '.$index==4?'class="active"':''.'><a href="./presence.php"><i class="fa-solid fa-clock"></i>Presence</a></li>
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
';}
?>
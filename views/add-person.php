<?php

if (isset($_COOKIE['role'])) {
    $cookieRole = $_COOKIE['role'];
} else {
    // header('Location: ' . "./index.html");
            exit;
}
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
    <title>Add Person</title>
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
                // if($cookieRole=="admin"){
                    // echo '<li class="active"><a href="./members.php"><i class="fas fa-users"></i>Members</a></li>';
                // }
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
                <div class="back">
                    <a href="members.php"><i class="fa-solid fa-angle-left"></i></a>
                    <h1>Add Person:</h1>
                </div>
                <i class="fas fa-cog"></i>

            </div>
            <div class="add-details">
                <div class="form-container">
                    <form action="../controllers/auth/register.php" method="post" enctype="multipart/form-data">
                        <div class="part-one">
                            <div class="name">
                                <div class="input-field">
                                    <label for="firstName">First Name:</label> <br>
                                    <input type="text" id="firstName" name="firstName" placeholder="Ex : John">
                                </div>
                                <div class="input-field">
                                    <label for="lastName">Last Name:</label><br>
                                    <input type="text" name="lastName" placeholder="Ex : Doe">
                                </div>

                            </div>
                            <div class="birth-gender">
                                <div class="input-field">
                                    <label for="birthDate">Birthday:</label><br>
                                    <input type="date" name="birthDate" >
                                </div>
                                <div class="gender">
                                    <p>Gender:</p>
                                    <div class="input-field">
                                        <div class="radio-filed">
                                            <input type="radio" id="male" name="gender" value="male">
                                            <label for="male">Male</label>
                                        </div>

                                        <div class="radio-filed">
                                            <input type="radio" id="female" name="gender" value="femal">
                                            <label for="female">Female</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-field">
                                <label for="address">Address:</label> <br>
                                <input type="text" name="address"
                                    placeholder="Ex : 2, rue de l'Indépendance. 16000 ALGER.">
                            </div>
                            <div id="sal-phone" class="name">

                                <div class="input-field">
                                    <label for="phone">Phone:</label> <br>
                                    <input type="text" name="phone" placeholder="Ex :0556677889">
                                </div>
                                <div class="input-field">
                                    <label for="salary">Salary:</label><br>
                                    <input type="text" name="salary" placeholder="Ex : 20000">
                                </div>
                            </div>
                            <div class="name">
                                <div class="input-field">
                                    <label for="userName">Username:</label> <br>
                                    <input type="text" name="userName" placeholder="Ex : john_Doe_19">
                                </div>
                                <div class="input-field">
                                    <label for="id">User ID:</label> <label  style="padding:1px 10px; margin-left:20px;border:0.5px solid gray;cursor:pointer" onclick="connect()">Scan Card</label>
                                    <br>
                                    <input type="text" name="id" id="id" placeholder="Ex : A1Z2E3R4">
                                </div>
                            </div>
                            <div class="name">
                                <div class="input-field" id="sal-email">
                                    <label for="email">Email:</label><br>
                                    <input type="text" id="email" name="email" placeholder="Ex :azerty@gmail.com">
                                </div>
                                <div class="input-field">
                                    <label for="password">Password:</label> <br>
                                    <input type="password" id="password" name="password" placeholder="Ex :azerty123">
                                </div>
                            </div>
                            <div class="role-img">
                                <div class="role">
                                    <label for="role">Role:</label>
                                    <select id="role"  name="role" onchange="
                                        showHideElementPhone();   
                                        showHideElement()          
                                ">
                                        <option value="admin">Admin</option>
                                        <option value="sitter">Sitter</option>
                                        <option value="kid">Kid</option>
                                    </select>
                                </div>
                                <div class="img">
                                    <label for="">Image:</label>
                                    <label for="file" class="custom-file-input">Click to choose</label>
                                        <input type="text" id="fileInput" class="file-name" readonly>

                                    <input type="file" id="file" name="file" accept=".jpg, .jpeg, .png">
                                </div>
                            </div>
                            <div id="parent-part" class="parent-part">

                                <h1>Parent info:</h1>

                                <div class="name">
                                    <div class="input-field">
                                        <label for="p-firstName">First Name:</label> <br>
                                        <input type="text" id="p-firstName" name="p-firstName" placeholder="Ex : John">
                                    </div>
                                    <div class="input-field">
                                        <label for="p-lastName">Last Name:</label><br>
                                        <input type="text" name="p-lastName" placeholder="Ex : Doe">
                                    </div>

                                </div>
                                <div class="birth-gender">
                                  <div></div>
                                    <div class="gender">
                                        <p>Gender:</p>
                                        <div class="input-field">
                                            <div class="radio-filed">
                                                <input type="radio" id="p-male" name="p-gender" value="male">
                                                <label for="male">Male</label>
                                            </div>

                                            <div class="radio-filed">
                                                <input type="radio" id="p-female" name="p-gender" value="femal">
                                                <label for="female">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-field">
                                    <label for="p-address">Address:</label> <br>
                                    <input type="text" name="p-address"
                                        placeholder="Ex : 2, rue de l'Indépendance. 16000 ALGER.">
                                </div>
                                <div class="name">
                                    <div class="input-field">
                                        <label for="p-email">Email:</label><br>
                                        <input type="text" id="p-email" name="p-email"
                                            placeholder="Ex :azerty@gmail.com">
                                    </div>
                                    <div class="input-field">
                                        <label for="p-phone">Phone:</label> <br>
                                        <input type="text" id="p-phone" name="p-phone" placeholder="Ex :azerty123">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Finish">
                        </div>

                    </form>
                </div>

            </div>

        </div>

    </div>
    <script>
        document.getElementById('file').addEventListener('change', function () {
            var fileName = this.value.split('\\').pop();
            document.getElementById('fileInput').value = fileName;
        });
        function showHideElement() {
            var selectElement = document.getElementById("role");
            var selectedValue = selectElement.value;
            var hiddenElement = document.getElementById("parent-part");
            if (selectedValue === "kid") {
                hiddenElement.style.display = "block";
            } else {
                hiddenElement.style.display = "none";
            }
        }
        function showHideElementPhone() {
            var selectElement = document.getElementById("role");
            var selectedValue = selectElement.value;
            var hiddenElement = document.getElementById("sal-phone");
            var hiddenElement1 = document.getElementById("sal-email");
            if (selectedValue === "kid") {
                hiddenElement.style.display = "none";
                hiddenElement1.style.display = "none";
            } else {
                hiddenElement.style.display = "flex";
                hiddenElement1.style.display = "flex";
            }
        }
        showHideElementPhone()
    </script>

    
<script>
  let port;

  async function connect() {
    try {
      port = await navigator.serial.requestPort({
      });

      await port.open({ baudRate: 9600 });


      const reader = port.readable.getReader();

      while (true) {
        const { value, done } = await reader.read();
        if (done) break;
        appendToOutput(new TextDecoder().decode(value));
      }

    } catch (error) {
      console.error('Error: ', error);
    }
  }

  function appendToOutput(message) {
    const code = document.getElementById('id');
    if(message){
      code.value += message;
    }
  }
</script>


<script>
  let port;

  async function connect() {
    try {
      port = await navigator.serial.requestPort({
      });

      await port.open({ baudRate: 9600 });


      const reader = port.readable.getReader();

      while (true) {
        const { value, done } = await reader.read();
        if (done) break;
        appendToOutput(new TextDecoder().decode(value));
      }

    } catch (error) {
      console.error('Error: ', error);
    }
  }

  function appendToOutput(message) {
    const code = document.getElementById('code');
    if(message){
      code.value += message;
    }
  }
</script>



</body>

</html>
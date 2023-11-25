<?php
require_once  '../../models/auth.php';
require_once  '../../models/admin.php';
require_once  '../../models/kid.php';
require_once  '../../models/sitter.php';
require_once  '../../models/child-parent.php';
function post()
{
    echo "data<br>";
    $id = $_POST['id'];
    $userName = isset($_POST['userName'])?$_POST['userName']:null;
    $pw = isset($_POST['password'])?$_POST['password']:null;
    $firstName = isset($_POST['firstName'])?$_POST['firstName']:null;
    $lastName = isset($_POST['lastName'])?$_POST['lastName']:null;
    $address = isset($_POST['address'])?$_POST['address']:null;
    $gender = isset($_POST['gender'])?$_POST['gender']:null;
    $birthDate = isset($_POST['birthDate'])?$_POST['birthDate']:null;
    $salary = isset($_POST['salary'])?$_POST['salary']:null;
    $email = isset($_POST['email'])?$_POST['email']:null;
    $phone = isset($_POST['phone'])?$_POST['phone']:null;
    $role = isset($_POST['role'])?$_POST['role']:null;
    $classroom = isset($_POST['classroom'])?$_POST['classroom']:null;

    $pFirstName= isset($_POST['p-firstName'])?$_POST['p-firstName']:null;
    $pLastName= isset($_POST['p-lastName'])?$_POST['p-lastName']:null;
    $pAddress= isset($_POST['p-address'])?$_POST['p-address']:null;
    $pGender= isset($_POST['p-gender'])?$_POST['p-gender']:null;
    $pEmail= isset($_POST['p-email'])?$_POST['p-email']:null;
    $pPhone= isset($_POST['p-phone'])?$_POST['p-phone']:null;

    $image = "";
    
    if (isset($_FILES["file"])) {
        $targetDir = "../../uploads/";
        $targetFile = $targetDir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, the file already exists.";
            $uploadOk = 0;
            exit;
        }
    
        // Check file size less than 100KB
        if ($_FILES["file"]["size"] > 1024*100) {
            echo "Sorry, your file is too large. ";
            $uploadOk = 0;
            exit;
        }
    
        // Allow image extentions
        $allowedFormats = ["jpg", "jpeg", "png"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
            $uploadOk = 0;
            exit;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            exit;
        } else {
            // If everything is ok, try to upload the file
            echo $_FILES["file"]["tmp_name"]."<br>";
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
                $image = htmlspecialchars(basename($_FILES["file"]["name"]));   
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit;
            }
        }
    } else {
        // Display an error if the form was not submitted properly
        echo "Error: Invalid form submission.";
        exit;
    }
    
    



    $credentialId = Credential::registerWithId($id,$userName, $pw, $role);

    echo "credential" . $credentialId;
    echo "<br>";
    echo " $birthDate,<br>";

    
$data = array(
    "id" => $id,
    "userName" => $userName,
    "firstName" => $firstName,
    "lastName" => $lastName,
    "address" => $address,
    "gender" => $gender,
    "birthDate" => $birthDate,
    "image" => $image,
    "email" => $email,
    "phone" => $phone,
    "salary" => $salary,
    "role" => $role,
    "classroom" => $classroom,
    "credentialId" => $credentialId,
  );



    switch ($role) {
        case Role::ADMIN:
            Admin::create($data);
            break;
        case Role::SITTER:
            Sitter::create($data);
            break;
        case Role::KID:
            $pData =array(
                "firstName"=>$pFirstName,
                "lastName"=>$pLastName,    
                "address"=>$pAddress,
                "gender"=>$pGender,    
                "email"=>$pEmail,
                "phone"=>$pPhone,      
                );
                $pid = ChildParent::create($pData);
                $data["parent"]=$pid;
                Kid::create($data);
            break;
        
        default:
            return false;
    }

    echo json_encode(array("status" => 200, "message" => "user created successfully "));
    header('Location: ' . "../../views/login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    post();
} else {
    echo json_encode(array("status" => 400, "message" => "not found"));
}


?>
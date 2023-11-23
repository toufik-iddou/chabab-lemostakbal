<?php
require_once  '../../models/auth.php';
require_once  '../../models/admin.php';
require_once  '../../models/kid.php';
require_once  '../../models/sitter.php';
require_once  '../../models/child-parent.php';
function post()
{
    echo "data<br>";
    $userName = $_POST['userName'];
    $pw = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $birthDate = $_POST['birthDate'];
    $salary = $_POST['salary'];
    $role = $_POST['role'];
    $level = $_POST['level'];
    var_dump($_POST);
    echo "$pw pass<br>";




    $credentialId = Credential::register($userName, $pw, $role);

    echo "credential" . $credentialId;
    echo "<br>";
    echo " $birthDate,<br>";

    
$data = array(
    "userName" => $userName,
    "firstName" => $firstName,
    "lastName" => $lastName,
    "address" => $address,
    "gender" => $gender,
    "birthDate" => $birthDate,
    "salary" => $salary,
    "role" => $role,
    "level" => $level,
    "credentialId" => $credentialId,
  );
  


    switch ($role) {
        case Role::ADMIN:
            $isUser = Admin::create($data);
            break;
        case Role::SITTER:
            $isUser = Sitter::create($data);
            break;
        case Role::KID:
            $isUser = Kid::create($data);
            break;
        case Role::PARENT:
            $isUser = ChildParent::create($data);
            break;
        default:
            return false;
    }

    // echo json_encode(array("status" => 200, "message" => "user created successfully "));

}
echo "post start<br>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    post();
} else {
    echo json_encode(array("status" => 400, "message" => "not found"));
}

?>
?>
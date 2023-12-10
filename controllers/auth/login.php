<?php
require_once  '../../models/auth.php';
require_once  '../../models/admin.php';
require_once  '../../models/kid.php';
require_once  '../../models/sitter.php';
require_once  '../../models/child-parent.php';
function post()
{
    require_once __DIR__ . '/../../utils/statics.php';
    
    $userName = $_POST['userName'];
    $pw = $_POST['password'];
    
    $cred = Credential::login($userName, $pw);
    if ($cred === null) {
        echo json_encode(array("status" => 400, "message" => "username or password incorrect"));
        header("Location: $hostLocationViews/login.html");
        exit;
    }
    
    $user = null;
    switch ($cred->getRole()) {
        case Role::ADMIN:
            $user = Admin::getByCredential($cred);
            break;
        case Role::SITTER:
            $user = Sitter::getByCredential($cred);
            break;
        case Role::KID:
            $user = Kid::getByCredential($cred);
            break;
        default:
            $user = null;
    }
    if ($user === null) {
        echo json_encode(array("status" => 400, "message" => "unknown user"));
        header("Location: $hostLocationViews/login.html");
        exit;
    }
    $user->setCredential($cred);
    setcookie("id", $user->getId(), time() + (86400 * 30), "/");
    setcookie("role",$cred->getRole(), time() + (86400 * 30), "/");
    setcookie("userName", $cred->getUserName(), time() + (86400 * 30), "/");
    setcookie("credentialId", $cred->getId(), time() + (86400 * 30), "/");
    echo json_encode(array("status" => 200, "message" => "welcome"));
    echo gethostname();
    header("Location: $hostLocationViews/sessions.php");
    exit;

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    post();
} else {
    echo json_encode(array("status" => 400, "message" => "not found"));
}

?>
?>
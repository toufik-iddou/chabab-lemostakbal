<?php
require_once  '../../models/pointing.php';
function post(){
    $uid = $_POST['uid'];
    $data = array(
        "uid" => $uid,);
        Pointing::create($data);
        echo json_encode(array("status" => 200, "message" => "welcome"));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    post();

} else{
    echo json_encode(array("status" => 400, "message" => "not found"));
}
?>

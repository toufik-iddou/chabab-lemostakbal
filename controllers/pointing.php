<?php
require_once  '../models/pointing.php';
function post(){
    $user = $_POST['user'];
    $currentDate = date('Y-m-d');
    $data = array(
        "user" => $user,
        "date" =>$currentDate,
    );
        $isExist = Pointing::exist($data);
        if($isExist){
            echo json_encode(array("status" => 200, "message" => "your are already poined"));
        }else{
            Pointing::create($data);
            echo json_encode(array("status" => 200, "message" => "welcome"));
        }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    post();

} else{
    echo json_encode(array("status" => 400, "message" => "not found"));
}
?>

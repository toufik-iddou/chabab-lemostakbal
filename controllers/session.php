<?php
require_once  '../models/session.php';

function post()
{
    require_once __DIR__ . '/../utils/statics.php';
    $classroom = $_POST['classroom'];
    $activity = $_POST['activity'];
    $day = $_POST['day'];
    $startAt = $_POST['start-at'];
    $endAt = $_POST['end-at'];
$data=array(
"classroom"=>$classroom,
"activity"=>$activity,
"day"=>$day,
"start_at"=>$startAt,
"end_at"=>$endAt,
);
    Session::create($data);
    echo json_encode(array("status" => 200, "message" => "Class created successfully"));
    header("Location: $hostLocationViews/sessions.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    post();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

} else {

}
?>

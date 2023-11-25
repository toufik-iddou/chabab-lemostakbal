<?php
require_once  '../models/classroom.php';

function post()
{
    require_once __DIR__ . '/../../utils/statics.php';
    $name = $_POST['name'];
    $sitter = $_POST['sitter'];
    $level = $_POST['level'];
$data=array(
"name"=>$name,
"sitter"=>$sitter,
"level"=>$level
);
    Classroom::create($data);
    echo json_encode(array("status" => 200, "message" => "Classroom created successfully"));
    header("Location: $hostLocationViews/classroom.php");
}

function delete()
{
    require_once __DIR__ . '/../../utils/statics.php';
    $id = $_POST['id'];
  
    Classroom::deleteById($id);
    echo json_encode(array("status" => 200, "message" => "Classroom deleted successfully"));
    header("Location: $hostLocationViews/classroom.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    post();
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    delete();
} else {

}
?>

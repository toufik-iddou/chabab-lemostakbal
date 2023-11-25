<?php
function Select_query($sql):array{
    require __DIR__ . '/../services/connect.php';
    $result = $conn->query($sql);
    $data =[] ;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            array_push($data,$row);
        }}
    $conn->close();
    return $data;
   }
?>
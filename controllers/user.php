<?php
// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo 'This is a GET request.';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the request method is POST
    echo 'This is a POST request.';
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Check if the request method is PUT
    echo 'This is a PUT request.';
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Check if the request method is DELETE
    echo 'This is a DELETE request.';
} else {
    // Handle other request methods if needed
    echo 'This is a different type of request.';
}
?>

<?php
// index.php

// Get the requested URL
$request_uri = $_SERVER['REQUEST_URI'];

// Define your dynamic routes
$dynamic_routes = [
    '/user/(\d+)' => 'user.php?id=$1',
    '/post/(\w+)' => 'post.php?slug=$1',
];

// Check if the requested URL matches a dynamic route
foreach ($dynamic_routes as $pattern => $destination) {
    if (preg_match("#^$pattern$#", $request_uri, $matches)) {
        // Extract parameters from the URL
        array_shift($matches); // Remove the full match
        $params = $matches;

        // Include the corresponding file with parameters
        include str_replace('$', '', preg_replace_callback('/\$(\d+)/', function($matches) use ($params) {
            return $params[$matches[1] - 1];
        }, $destination));

        // Stop further processing
        exit();
    }
} 

// If no matching dynamic route is found, handle it as a 404 error
http_response_code(404);
echo '404 Not Found';
?>

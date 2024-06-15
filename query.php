<?php
// Simulating a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

// Check if the 'sql' parameter is provided
if (isset($_GET['sql'])) {
    // Get the 'sql' parameter from the URL
    $sql = $_GET['sql'];

    // Execute the SQL query (in a real application, this would be done using a database connection)
    // For demonstration purposes, we're just returning a hardcoded response
    if ($sql === "SELECT * FROM users WHERE id = '1'") {
        $response = [
            'success' => true,
            'data' => [
                ['id' => 1, 'name' => 'John Doe'],
                ['id' => 2, 'name' => 'Jane Smith']
            ]
        ];
    } else {
        $response = [
            'success' => false,
            'error' => 'Invalid SQL query'
        ];
    }

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>

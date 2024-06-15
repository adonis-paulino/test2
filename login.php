<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";  // Change this to your database username
$password = "";  // Change this to your database password
$dbname = "testdb2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'] ?? '';
    $input_password = $_POST['password'] ?? '';

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->bind_result($stored_password);
    $stmt->fetch();
    $stmt->close();

    // Check if credentials match
    if ($stored_password && $stored_password === $input_password) {
        // Generate a session ID (insecurely)
        $session_id = session_id();
        // Store username in session
        $_SESSION['username'] = $input_username;
        // Redirect to dashboard.php with the session ID in the URL
        header("Location: dashboard.php?session_id=$session_id");
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .vulnerable-text {
            background-color: brown;
            color: wheat;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <div class="vulnerable-text">
        This page is vulnerable! It uses default admin passwords, exposes your session ID in the URL, and saves your password in plaintext in the database.
    </div>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
        <div></div>
    </form>
</body>
</html>

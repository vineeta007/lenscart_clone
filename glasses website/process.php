<?php
// Database connection details
$host = 'localhost'; // Database host
$dbname = 'website_db'; // Database name
$username = 'root'; // MySQL username
$password = 'vdevnani007'; // MySQL password (default is empty)

// Capture form data
$formUsername = $_POST['username'];
$formPassword = $_POST['password'];

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $formUsername);
    $stmt->bindParam(':password', $formPassword);
    $stmt->execute();

    // Check if user exists
    if ($stmt->rowCount() > 0) {
        echo "Login successful! Welcome, " . htmlspecialchars($formUsername) . ".";
    } else {
        echo "Invalid username or password.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

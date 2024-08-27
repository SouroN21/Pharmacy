<?php
require_once 'config.php'; 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare the SQL query with parameterized placeholder
    $sql = "SELECT id_admin, uname_admin, upass_admin FROM pharmacy_admin WHERE uname_admin = :username";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($sql);
        
        // Bind the parameter
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();

        // Fetch user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify user credentials
        if ($user && password_verify($password, $user['upass_admin'])) {
            // Authentication successful
            $_SESSION['user_id'] = $user['id_admin'];
            $_SESSION['username'] = $user['uname_admin'];
            header("Location: ../dashboard.php");
            exit();
        } else {
            // Authentication failed
            $_SESSION['error'] = "Invalid username or password.";
            header("Location: ../pages/login3.php"); 
            exit();
        }
    } catch (PDOException $e) {
        // Handle any errors
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: ../pages/login2.php"); 
        exit();
    }
} else {
    // Redirect if not a POST request
    header("Location: ../pages/login1.php");
    exit();
}
?>

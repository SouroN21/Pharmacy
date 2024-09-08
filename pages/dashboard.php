<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: ../pages/login.php");
    exit();
}

// Retrieve session data
$username = $_SESSION['username'];
$userType = $_SESSION['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Styles/dashboard.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome to the Dashboard</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>User Type:</strong> <?php echo htmlspecialchars($userType); ?></p>
        
        <h3>Actions</h3>
        <ul>
            <li><a href="../pages/profile.php">View Profile</a></li>
            <li><a href="../pages/settings.php">Settings</a></li>
            <li><a href="../pages/logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
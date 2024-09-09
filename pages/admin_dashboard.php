<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to the login page if not logged in or not an admin
    header("Location: ../pages/login.php");
    exit();
}

// Retrieve admin information from the database
$admin = getAdminInfo($_SESSION['username']);

function getAdminInfo($username) {
    require_once '../PHP/config.php'; // Include your database configuration file

    try {
        $stmt = $conn->prepare("SELECT uname_admin FROM pharmacy_admin WHERE uname_admin = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Styles/admin_dashboard.css">
    <script src="../JS/admin.js" defer></script> 
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="../PHP/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Manage Details</h2>
            <div class="button-group">
                <button class="view-button" data-type="user">View Users</button>
                <button class="view-button" data-type="pharmacy">View Pharmacies</button>
                <button class="view-button" data-type="pharmacist">View Pharmacists</button>
                <button class="view-button" data-type="feedback">View Feedback</button>
                <button class="view-button" data-type="contact">View Contact Us Info</button>
            </div>
        </section>
        <section id="content">
            <!-- Dynamic content will be loaded here -->
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Your Company. All rights reserved.</p>
    </footer>
</body>
</html>
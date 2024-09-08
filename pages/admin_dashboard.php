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
                <li><a href="logout.php">Logout</a></li>
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
        <section>
            <h2>Admin Profile</h2>
            <div class="profile-info">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($admin['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Your Company. All rights reserved.</p>
    </footer>
</body>
</html>

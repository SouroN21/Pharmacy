<?php
session_start(); 

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'pharmacy') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Dashboard</title>
    <link rel="stylesheet" href="../Styles/pharmacy_dashboard.css"> 
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to the Pharmacy Dashboard</h1>
            <p>Logged in as: <strong><?php echo htmlspecialchars($username); ?></strong></p>
            <nav>
                <ul>
                    <li><a href="all_medicines.php">All Medicines</a></li>
                    <li><a href="add_medicine.php">Add Medicine</a></li>
                    <li><a href="view_prescriptions.php">View Prescriptions</a></li>
                    <li><a href="inventory.php">Manage Inventory</a></li>
                    <li><a href="../PHP/logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section>
                <h2>Dashboard Overview</h2>
                <p>Here you can manage your pharmacy operations efficiently.</p>
                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Total Medicines</h3>
                        <p>150</p>
                    </div>
                    <div class="card">
                        <h3>Prescriptions</h3>
                        <p>30</p> 
                    </div>
                    <div class="card">
                        <h3>Sales Today</h3>
                        <p>$500</p>
                    </div>
                </div>
            </section>
        </main>
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Your Pharmacy. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
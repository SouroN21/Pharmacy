<?php
session_start(); // Start the session

// Check if the user is logged in as a pharmacist
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'pharmacy') {
    // Redirect to the login page if not logged in or not a pharmacist
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <link rel="stylesheet" href="../Styles/add_medicine.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Pharmacy Dashboard</h1>
            <p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
            <nav>
                <ul>
                    <li><a href="pharmacy_dashboard.php">Dashboard</a></li>
                    <li><a href="all_medicines.php">All Medicines</a></li>
                    <li><a href="view_prescriptions.php">View Prescriptions</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h2>Add Medicine</h2>
            <form method="POST" action="../PHP/add_medicine.php" enctype="multipart/form-data">
                <label for="medicine_name">Medicine Name:</label>
                <input type="text" id="medicine_name" name="medicine_name" required>

                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required></textarea>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <button type="submit">Add Medicine</button>
            </form>
        </main>
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Your Pharmacy. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
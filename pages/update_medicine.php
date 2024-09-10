<?php
session_start(); 

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'pharmacy') {
    header("Location: login.php");
    exit();
}

// Include database configuration
require_once '../PHP/config.php'; 

// Get the medicine ID from the query parameter
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Fetch the medicine details from the database
$query = "SELECT * FROM medicines WHERE id = ?"; 
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$medicine = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medicine</title>
    <link rel="stylesheet" href="../Styles/all_medicines.css"> 
</head>
<body>
    <div class="container">
        <header>
            <h1>Update Medicine</h1>
            <nav>
                <ul>
                    <li><a href="pharmacy_dashboard.php">Dashboard</a></li>
                    <li><a href="all_medicines.php">All Medicines</a></li>
                    <li><a href="add_medicine.php">Add Medicine</a></li>
                    <li><a href="medicine_store.php">Medicine Store</a></li>
                    <li><a href="view_prescriptions.php">View Prescriptions</a></li>
                    <li><a href="../PHP/logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <form method="POST" action="../PHP/update_medicine.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($medicine['id']); ?>">
                
                <label for="medicine_name">Medicine Name:</label>
                <input type="text" id="medicine_name" name="medicine_name" value="<?php echo htmlspecialchars($medicine['medicine_name']); ?>" required>
                
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($medicine['price']); ?>" required>
                
                <label for="description">Description:</label>
                <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($medicine['description']); ?></textarea>
                
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*">
                
                <button type="submit">Update Medicine</button>
            </form>
        </main>
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Your Pharmacy. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close(); 
?>
<?php
session_start(); 

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'pharmacy') {
    header("Location: login.php");
    exit();
}

// Include database configuration
require_once '../PHP/config.php'; 

// Fetch all medicines from the database
$query = "SELECT * FROM medicines"; 
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Medicines</title>
    <link rel="stylesheet" href="../Styles/all_medicines.css"> 
</head>
<body>
    <div class="container">
        <header>
            <h1>All Medicines</h1>
            <nav>
                <ul>
                    <li><a href="pharmacy_dashboard.php">Dashboard</a></li>
                    <li><a href="add_medicine.php">Add Medicine</a></li>
                    <li><a href="medicine_store.php">Medicine Store</a></li>
                    <li><a href="view_prescriptions.php">View Prescriptions</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Medicine Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['medicine_name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['price']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                            echo '<td><img src="../uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['medicine_name']) . '" style="width: 50px; height: auto;"></td>';
                            echo '<td>
                                    <a href="update_medicine.php?id=' . htmlspecialchars($row['id']) . '" class="button">Update</a>
                                    <form method="POST" action="../PHP/delete_medicine.php" style="display:inline;">
                                        <input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">
                                        <button type="submit" class="button1" onclick="return confirm(\'Are you sure you want to delete this medicine?\');">Delete</button>
                                    </form>
                                  </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6">No medicines found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </main>
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Your Pharmacy. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>

<?php
$conn->close(); 
?>
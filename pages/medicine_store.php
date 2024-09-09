<?php
session_start(); // Start the session

// Include database configuration
require_once '../PHP/config.php'; // Make sure this file contains your database connection details

// Fetch medicines from the database
$query = "SELECT * FROM medicines"; // Adjust table name as necessary
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Store</title>
    <link rel="stylesheet" href="../Styles/medicine_store.css"> 
</head>
<body>
    <div class="container">
        <header>
            <h1>Medicine Store</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="medicine_store.php">Medicine Store</a></li>
                    <li><a href="upload_prescription.php">Upload Prescription</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <div class="medicine-grid">
                <?php
                // Check if there are results and display them
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="medicine-card">';
                        echo '<img src="../uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['medicine_name']) . '">';
                        echo '<h3>' . htmlspecialchars($row['medicine_name']) . '</h3>';
                        echo '<p>Price: $' . htmlspecialchars($row['price']) . '</p>';
                        echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                        echo '<a href="add_to_cart.php?id=' . htmlspecialchars($row['id']) . '" class="button">Buy Now</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No medicines found.</p>';
                }
                ?>
            </div>
        </main>
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Your Pharmacy. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
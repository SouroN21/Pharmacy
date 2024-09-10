<?php
session_start(); 

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'user') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Include database configuration
require_once '../PHP/config.php'; 

// Fetch medicines from the database
$query = "SELECT * FROM medicines"; 
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
                    <li><a href="../PHP/logout.php" class="button_logout-button">Logout :<?php echo htmlspecialchars($username); ?></a></li> 
                </ul>
            </nav>
        </header>
        <main>
            <h2>Featured Medicines</h2>
            <div class="medicine-grid">
                <?php
                // Check if there are results and display them
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="medicine-card">';
                        echo '<img src="../uploads/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['medicine_name']) . '">';
                        echo '<h3>' . htmlspecialchars($row['medicine_name']) . '</h3>';
                        echo '<p>Price: Rs :' . htmlspecialchars($row['price']) . '</p>';
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
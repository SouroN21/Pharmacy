<?php
session_start(); 

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'user') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Include database configuration
require_once '../PHP/config.php'; 

$query = "SELECT * FROM medicines LIMIT 3"; 
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Pharmacy</title>
    <link rel="stylesheet" href="../Styles/index.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Welcome to Our Online Pharmacy</h1>
            <p>Logged in as: <strong><?php echo htmlspecialchars($username); ?></strong></p>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="medicine_store.php">Medicine Store</a></li>
                    <li><a href="upload_prescription.php">Upload Prescription</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="../PHP/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <h2>Featured Medicines</h2>
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
                    echo '<p>No featured medicines found.</p>';
                }
                ?>
            </div>
        </div>

        <div class="container">
            <h2>Our Services</h2>
            <div class="service-grid">
                <div class="service-card">
                    <img src="../Images/prescription.svg" alt="Upload Prescription">
                    <h3>Upload Prescription</h3>
                    <p>Upload your prescription and get your medicines delivered.</p>
                    <a href="upload_prescription.php" class="button">Upload Now</a>
                </div>
                <div class="service-card">
                    <img src="../Images/delivery.svg" alt="Fast Delivery">
                    <h3>Fast Delivery</h3>
                    <p>Get your medicines delivered to your doorstep quickly.</p>
                    <a href="medicine_store.php" class="button">Shop Now</a>
                </div>
                <div class="service-card">
                    <img src="../Images/support.svg" alt="Customer Support">
                    <h3>Customer Support</h3>
                    <p>Our team is here to assist you with any queries or concerns.</p>
                    <a href="contact.php" class="button">Contact Us</a>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Your Pharmacy. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
<?php
session_start(); // Start the session

// Check if the user is logged in as a pharmacist
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'pharmacy') {
    // Redirect to the login page if not logged in or not a pharmacist
    header("Location: login.php");
    exit();
}

// Include database configuration
require_once 'config.php'; // Make sure this file contains your database connection details

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the medicine ID from the POST request
    $id = $_POST['id'];

    // Prepare SQL statement to delete the medicine
    $stmt = $conn->prepare("DELETE FROM medicines WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>
                alert("Medicine deleted successfully!");
                window.location.href = "../pages/all_medicines.php";
              </script>';
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close(); // Close the database connection
?>
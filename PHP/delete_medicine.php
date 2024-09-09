<?php
session_start(); 

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'pharmacy') {
    header("Location: ../pages/login.php");
    exit();
}

// Include database configuration
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

$conn->close(); 
?>
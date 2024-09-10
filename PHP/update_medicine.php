<?php
session_start(); 

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'pharmacy') {
    header("Location: login.php");
    exit();
}

// Include database configuration
require_once 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated form data
    $id = $_POST['id'];
    $medicine_name = $_POST['medicine_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Handle image update
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($image);
        
        // Move the uploaded image to the uploads directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Update the medicine details with the new image
            $query = "UPDATE medicines SET medicine_name = ?, price = ?, description = ?, image = ? WHERE id = ?"; 
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sdssi", $medicine_name, $price, $description, $image, $id);
        } else {
            echo "Error uploading image.";
        }
    } else {
        // Update the medicine details without changing the image
        $query = "UPDATE medicines SET medicine_name = ?, price = ?, description = ? WHERE id = ?"; 
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdsi", $medicine_name, $price, $description, $id);
    }
    
    if ($stmt->execute()) {
        header("Location: ../pages/all_medicines.php"); // Redirect to the all medicines page
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close(); 
?>
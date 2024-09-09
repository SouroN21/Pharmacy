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
    // Retrieve form data
    $medicine_name = $_POST['medicine_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $pharmacy_name = $_SESSION['username']; // Store the logged-in pharmacy name

    // Handle image upload
    $image = $_FILES['image']['name'];
    $target_dir = "../uploads/"; // Directory to save uploaded images
    $target_file = $target_dir . basename($image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 5MB)
    if ($_FILES["image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Prepare SQL statement to insert medicine details into the database
            $stmt = $conn->prepare("INSERT INTO medicines (medicine_name, price, description, image, pharmacy_name) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sdsss", $medicine_name, $price, $description, $image, $pharmacy_name);

            // Execute the statement
            if ($stmt->execute()) {
                echo "New medicine added successfully!";
                header("Location: ../pages/all_medicines.php"); // Redirect to medicine store after successful addition
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close(); // Close the database connection
?>
<?php
require_once 'config.php'; // Include the database connection file

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userType = $_POST['user_type'];
    
    // Initialize variables
    $username = '';
    $password = '';
    $confirmPassword = '';
    $pharmacyName = null;
    $licenseNumber = null;
    $pharmacistName = null; // Added for pharmacist's name

    // Get common fields
    if ($userType === 'user') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
    } elseif ($userType === 'pharmacy') {
        $pharmacyName = $_POST['pharmacy_name'];
        $username = $_POST['pharmacy_username'];
        $password = $_POST['pharmacy_password'];
        $confirmPassword = $_POST['pharmacy_confirm_password'];
    } elseif ($userType === 'pharmacist') {
        $pharmacistName = $_POST['pharmacist_name']; // Capture pharmacist's name
        $username = $_POST['pharmacist_username'];
        $password = $_POST['pharmacist_password'];
        $confirmPassword = $_POST['pharmacist_confirm_password'];
        $licenseNumber = $_POST['license_number'];
    }

    // Validate password confirmation
    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match !");</script>';
        header("Location: ../pages/register.php");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement based on user type
    if ($userType === 'user') {
        $sql = "INSERT INTO pharmacy_user (uname_user, upass_user) VALUES ('$username', '$hashedPassword')";
    } elseif ($userType === 'pharmacy') {
        $sql = "INSERT INTO pharmacy_pharmacy (name_pharmacy, uname_pharmacy, upass_pharmacy) VALUES ('$pharmacyName', '$username', '$hashedPassword')";
    } elseif ($userType === 'pharmacist') {
        $sql = "INSERT INTO pharmacy_pharmacist (name_pharmacist, uname_pharmacist, upass_pharmacist, license_harmacist) VALUES ('$pharmacistName', '$username', '$hashedPassword', '$licenseNumber')";
    }

    if ($conn->query($sql) === TRUE) {
        if ($userType === 'user') {
            echo '<script>alert("User registered successfully!"); window.location.href = "../pages/login.php";</script>';
        } elseif ($userType === 'pharmacy') {
            echo '<script>alert("Pharmacy registered successfully!"); window.location.href = "../pages/login.php";</script>';
        } elseif ($userType === 'pharmacist') {
            echo '<script>alert("Pharmacist registered successfully!"); window.location.href = "../pages/login.php";</script>';
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
} else {
    echo '<script>alert("Error !");</script>';
    header("Location: ../pages/login.php");
    exit();
}
?>
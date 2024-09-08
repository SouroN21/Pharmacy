<?php
require_once 'config.php'; 
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Initialize a variable to track if the user is found
    $userFound = false;

    // Check user type and validate credentials
    // Check in pharmacy_user table
    $stmt = $conn->prepare("SELECT upass_user FROM pharmacy_user WHERE uname_user = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['upass_user'])) {
            $_SESSION['username'] = $username; // Set session variable
            $_SESSION['user_type'] = 'user'; // Set user type
            header("Location: ../pages/dashboard.php"); // Redirect to dashboard
            exit();
        }
    }

    // Check in pharmacy_pharmacy table
    $stmt = $conn->prepare("SELECT upass_pharmacy FROM pharmacy_pharmacy WHERE uname_pharmacy = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['upass_pharmacy'])) {
            $_SESSION['username'] = $username; // Set session variable
            $_SESSION['user_type'] = 'pharmacy'; // Set user type
            header("Location: ../pages/dashboard.php"); // Redirect to dashboard
            exit();
        }
    }

    // Check in pharmacy_pharmacist table
    $stmt = $conn->prepare("SELECT upass_pharmacist FROM pharmacy_pharmacist WHERE uname_pharmacist = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['upass_pharmacist'])) {
            $_SESSION['username'] = $username; // Set session variable
            $_SESSION['user_type'] = 'pharmacist'; // Set user type
            header("Location: ../pages/dashboard.php"); // Redirect to dashboard
            exit();
        }
    }

    // Check in pharmacy_admin table
    $stmt = $conn->prepare("SELECT upass_admin FROM pharmacy_admin WHERE uname_admin = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['upass_admin'])) {
            $_SESSION['username'] = $username; // Set session variable
            $_SESSION['user_type'] = 'admin'; // Set user type
            header("Location: ../pages/dashboard.php"); // Redirect to dashboard
            exit();
        }
    }

    // If we reach here, the login failed
    echo '<script>
            document.getElementById("error").style.display = "block";
          </script>';
} else {
    // Redirect to login page if not a POST request
    header("Location: ../pages/login.php");
    exit();
}
?>
<?php
require_once 'config.php'; 
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userFound = false;

    $stmt = $conn->prepare("SELECT upass_user FROM pharmacy_user WHERE uname_user = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['upass_user'])) {
            $_SESSION['username'] = $username; 
            $_SESSION['user_type'] = 'user'; 
            header("Location: ../pages/index.php"); 
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
            $_SESSION['username'] = $username; 
            $_SESSION['user_type'] = 'pharmacy'; 
            header("Location: ../pages/pharmacy_dashboard.php");
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
            $_SESSION['username'] = $username; 
            $_SESSION['user_type'] = 'pharmacist';
            header("Location: ../pages/dashboard.php"); 
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
            $_SESSION['username'] = $username; 
            $_SESSION['user_type'] = 'admin'; 
            header("Location: ../pages/admin_dashboard.php"); 
            exit();
        }
    }

    // If we reach here, the login failed
    echo '<script>
            document.getElementById("error").style.display = "block";
          </script>';
} else {
    header("Location: ../pages/login.php");
    exit();
}
?>
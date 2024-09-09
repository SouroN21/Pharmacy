<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'config.php'; 

// Check if the user is logged in as an admin
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

// Get the type parameter from the URL
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Initialize the query variable
$query = '';

// Determine the query based on the type parameter
switch ($type) {
    case 'user':
        $query = "SELECT id_user AS id, uname_user AS username FROM pharmacy_user";
        break;
    case 'pharmacy':
        $query = "SELECT id_pharmacy AS id, name_pharmacy AS name , uname_pharmacy AS username FROM pharmacy_pharmacy";
        break;
    case 'pharmacist':
        $query = "SELECT id_pharmacist AS id, uname_pharmacist AS User_Name ,name_pharmacist AS name, license_harmacist AS license_number FROM pharmacy_pharmacist";
        break;
    case 'feedback':
        $query = "SELECT id, uname_user AS user, feedback FROM user_feedback"; // Adjust table name as necessary
        break;
    case 'contact':
        $query = "SELECT id, name, email, message FROM contact_us"; // Adjust table name as necessary
        break;
    default:
        header("HTTP/1.1 400 Bad Request");
        exit();
}

// Execute the query and fetch the results
$result = $conn->query($query);
if (!$result) {
    // Log the error if the query fails
    error_log("Database query failed: " . $conn->error);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Database query failed']);
    exit();
}

$data = [];

// Check if there are results and fetch them
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Set the content type to JSON and return the data
header('Content-Type: application/json');
echo json_encode($data);
?>
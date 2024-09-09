<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'config.php'; 

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

// Get the type and id parameters from the URL
$type = isset($_GET['type']) ? $_GET['type'] : '';
$id = isset($_GET['id']) ? $_POST['id'] : '';

// Initialize the query variable
$query = '';

// Determine the query based on the type parameter
switch ($type) {
    case 'user':
        $query = "DELETE FROM pharmacy_user WHERE id_user = ?";
        break;
    case 'pharmacy':
        $query = "DELETE FROM pharmacy_pharmacy WHERE id_pharmacy = ?";
        break;
    case 'pharmacist':
        $query = "DELETE FROM pharmacy_pharmacist WHERE id_pharmacist = ?";
        break;
    case 'feedback':
        $query = "DELETE FROM user_feedback WHERE id = ?"; 
        break;
    case 'contact':
        $query = "DELETE FROM contact_us WHERE id = ?"; 
        break;
    default:
        header("HTTP/1.1 400 Bad Request");
        exit();
}

// Prepare and execute the delete query
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Error deleting record']);
}
?>
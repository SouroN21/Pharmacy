<?php
// Database configuration
$host = 'localhost';
$dbname = 'pharmacy';
$username = 'root';
$password = '';

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
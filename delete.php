<?php
require 'db.php';

if (!isset($_GET["emp_id"])) {
    // No employee ID provided; redirect to index
    header("location: index.php");
    exit;
}

$emp_id = $_GET["emp_id"];

// Validate if emp_id is numeric to prevent SQL injection
if (!is_numeric($emp_id)) {
    die("Invalid employee ID.");
}

// Delete query
$sql = "DELETE FROM employees WHERE emp_id = $emp_id";
$result = $conn->query($sql);

if (!$result) {
    die("Error deleting record: " . $conn->error);
}

// Redirect to index after deletion
header("location: index.php");
exit;
?>
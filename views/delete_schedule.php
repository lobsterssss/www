<?php
require_once 'database/database.php';

// Initialize Database connection
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Call the delete function
    if ($db->delete_schedule($id)) {
        // Redirect back with a success message
        header("Location: /kookproject/schedule?message=deleted");
    } else {
        // Redirect back with an error message if deletion failed
        header("Location: /kookproject/schedule?message=delete_failed");
    }
    exit();
} else {
    // Redirect back if accessed improperly
    header("Location: /kookproject/schedule");
    exit();
}

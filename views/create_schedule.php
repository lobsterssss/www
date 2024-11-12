<?php
require_once 'database/database.php';

// Initialize Database connection
$db = new Database();

// Ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Check if the form action is 'create'
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        // Get form data and create the schedule
        $success = $db->create_schedule(
            $_POST['patient_id'],
            $_POST['medicijn_id'],
            $_POST['dosering'],
            $_POST['datum'],
            $_POST['tijdstip']
        );

        // Redirect back to schedule.php after creation with a success message
        if ($success) {
            header("Location: /kookproject/schedule?message=created");
        } else {
            header("Location: /kookproject/schedule?message=create_failed");
        }
        exit();
    }
}

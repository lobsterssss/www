<?php
require_once 'database/database.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $patient_id = filter_input(INPUT_POST, 'patient_id', FILTER_VALIDATE_INT);
    $medicijn_id = filter_input(INPUT_POST, 'medicijn_id', FILTER_VALIDATE_INT);
    $dosering = filter_input(INPUT_POST, 'dosering', FILTER_VALIDATE_FLOAT);
    // Use htmlspecialchars instead of FILTER_SANITIZE_STRING
    $datum = htmlspecialchars($_POST['datum'] ?? '', ENT_QUOTES, 'UTF-8');
    $tijdstip = htmlspecialchars($_POST['tijdstip'] ?? '', ENT_QUOTES, 'UTF-8');

    if ($id && $patient_id && $medicijn_id && $dosering && $datum && $tijdstip) {
        // Update the schedule
        $success = $db->update_schedule($id, $patient_id, $medicijn_id, $dosering, $datum, $tijdstip);
        
        if ($success) {
            header('Location: /kookproject/schedule?message=updated');
            exit;
        } else {
            header('Location: /kookproject/schedule?message=update_failed');
            exit;
        }
    } else {
        header('Location: /kookproject/schedule?message=invalid_input');
        exit;
    }
} else {
    header('Location: /kookproject/schedule');
    exit;
}
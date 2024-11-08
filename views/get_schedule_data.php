<?php
require_once 'database/database.php';
header('Content-Type: application/json');

$db = new Database();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $scheduleId = $_GET['id'];
    $schedule = $db->get_schedule_by_id($scheduleId);

    if ($schedule) {
        echo json_encode([
            'id' => $schedule['schedule_id'],
            'patient_id' => $schedule['patient_id'],
            'medicijn_id' => $schedule['medicijn_id'],
            'dosering' => $schedule['dosering'],
            'datum' => $schedule['datum'],
            'tijdstip' => $schedule['tijdstip']
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Schedule not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid ID provided']);
}

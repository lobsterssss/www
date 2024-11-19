<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $db = new Database;

        $planID = $Plan_ID; // From URL parameter
        $result = $db->edit_planning(
            $planID,
            $_POST['klantID'],
            $_POST['medicatie'],
            $_POST['innameFrequentie'],
            $_POST['datum'],
            $_POST['tijd'],
            $_POST['dosering'],
            $_POST['beperking']
        );

        header("HX-Location: /planningen");
    } catch (Exception $e) {
        echo "Error updating planning: " . htmlspecialchars($e->getMessage());
    }
}

<?php
    $db = new Database;
    $result = $db->delete_klant($Klant_ID);
    $db->close();
    header("HX-location:./patienten");

?>
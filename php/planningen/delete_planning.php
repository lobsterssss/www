<?php
    $db = new Database;
    $result = $db->delete_planning($Plan_ID);
    $db->close();
    header("HX-location:./planningen");

?>
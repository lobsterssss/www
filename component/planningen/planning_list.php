<?php
$db = new Database;
$planningen = $db->get_all_plannings();
$db->close();

?>
   
    <thead>
        <tr>
            <th>Patient</th>
            <th>Medicatie</th>
            <th>Inname Frequentie</th>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Dosering</th>
            <th>Beperking</th>
            <th>edit / destroy</th>                        
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($planningen as $planning):
                planning($planning);
            endforeach;
        ?>
    </tbody>

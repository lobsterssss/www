<?php
$db = new Database;
$patienten = $db->get_all_user_customers();
$db->close();

?>
   
    <thead>
        <tr>
            <th>Naam</th>
            <th>Leeftijd</th>
            <th>Woonplaats</th>
            <th>Adres</th>
            <th>Postcode</th>
            <th>telefoon</th>
            <th>E-mail</th>
            <th>edit / destroy</th>                        
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($patienten as $patient):
                patient($patient);
            endforeach;
        ?>
    </tbody>

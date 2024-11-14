<?php
$db = new Database;
$patienten = $db->get_all_user_customers($_SESSION["user"]["klant_id"]);
$db->close();

?>

<!DOCTYPE html>
<html>

<?php
head();
?>	

<body>
    <?php

    navigation();
    
    ?>
    <main>
        <article>
            <h1>Patienten</h1>
               <button hx-get="/register" hx-target=".overlay" onclick="toggle_visabilty()">New patient</button>
            <table>
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
            </table>
        </article>  
    </main>  
    <div class="overlay hidden" onclick="toggle_visabilty()"></div>
    <?= footer(); ?>
</body>

</html>
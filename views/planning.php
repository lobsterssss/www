<?php
$db = new Database;
$planningen = $db->get_all_plannings($_SESSION["user"]["Account_ID"]);
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
            <h1>Planningen</h1>
               <button hx-get="/kookproject/create-planning" hx-target=".overlay" onclick="toggle_visabilty()">New Planning</button>
               <table hx-get="/kookproject/planning_lijst" hx-trigger="load, every 5s" hx-target="table">
               </table>
        </article>  
    </main>  
    <div class="overlay hidden"></div>
    <?= footer(); ?>
</body>

</html>
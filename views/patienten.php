

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
               <table hx-get="/patienten_lijst" hx-trigger="load, every 5s" hx-target="table">
               </table>
        </article>  
    </main>  
    <div class="overlay hidden"></div>
    <?= footer(); ?>
</body>

</html>
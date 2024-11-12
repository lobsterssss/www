<?php 

    // $db = new Database;
    // if (isset$_GET["catagorie"] || isset$_GET["search_name"])
    // {

    // }
    // else{
    // // $medicines = $db->get_all_medicine();
    // }
    // $db->close();

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

    <div>
        <img src="/public/afbeeldingen/HHH_end.png" alt="placeholder" style="width:20%;height:20%;" class="center">
    </div>

    <div>
        <b>
            <h1>placeholder.txt</h1>
        </b>
        <p> placeholder.txt</p>
    </div>

    <div class="card-container">

        <?php
            // foreach($medicines as $medicine) {
            // medicine($medicine['image'], $medicine['name'], $medicine['desc']);
            // }
        ?>	


        <a href="placeholder.txt.html" class="card">
            <img src="/public/afbeeldingen/Biperideen.png" alt="Biperideen" class="card_img" style="width:90%; height: auto;">
            <h1 class="drugs">placeholder.txt</h1>
            <p class="info">
                placeholder.txt
            </p>
        </a>

        <a href="placeholder.txt.html" class="card">
            <img src="/public/afbeeldingen/PREGABRIAL_NT.png" alt="PREGABRIAL NT" class="card_img" style="width:90%; height: auto;">
            <h1 class="drugs">placeholder.txt</h1>
            <p class="info">
                placeholder.txt
            </p>
        </a>

        <a href="placeholder.txt.html" class="card">
            <img src="/public/afbeeldingen/SPASURET.png" alt="SPASURET" class="card_img" style="width:80%; height: auto;">
            <h1 class="drugs">placeholder.txt</h1>
            <p class="info">
                placeholder.txt
            </p>    
        </a>

        <a href="placeholder.txt.html" class="card">
            <img src="" alt="placeholder" class="card_img" style="width:50%; height: auto;">
            <h1 class="drugs">placeholder.txt</h1>
            <p class="info">
                placeholder.txt
            </p>
        </a>
    </div>
    <?= footer(); ?>
</body>

</html>

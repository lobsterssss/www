<?php
    function medicine($image, $drug_name, $info) {
?>

        <a href="" class="card">
            <img src="/public/afbeeldingen/<?php $image?>.png" alt=<?php $drug_name ?> class="card_img" style="width:40%; height: auto;">
            <h1 class="drugs"><?php $drug_name ?></h1>
            <p class="info">
                <?php $info ?>
            </p>
        </a>
<?php } ?>
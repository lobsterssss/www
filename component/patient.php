<?php
    function patient($patient) {
?>
    <tr>
        <th><?= $patient["Naam_Klant"] . " " . $patient["Achternaam"] ?></th>
        <th><?= $patient["Leeftijd"] ?></th>
        <th><?= $patient["Woonplaats"] ?></th>
        <th><?= $patient["Adres"] ?></th>
        <th><?= $patient["Postcode"] ?></th>
        <th><a href="tel:<?= $patient["Telefoonnummer"] ?>"><?= $patient["Telefoonnummer"] ?></a></th>
        <th><a href="email:<?= $patient["E-mail"] ?>"><?= $patient["E-mail"] ?></a></th>
        <th><button></button> <button></button></th>
    </tr>
<?php } ?>
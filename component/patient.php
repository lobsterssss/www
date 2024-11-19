<?php
    function patient($patient) {
?>
    <tr>
        <td><?= $patient["Naam_Klant"] . " " . $patient["Achternaam"] ?></td>
        <td><?= $patient["Leeftijd"] ?></td>
        <td><?= $patient["Woonplaats"] ?></td>
        <td><?= $patient["Adres"] ?></td>
        <td><?= $patient["Postcode"] ?></td>
        <td><a href="tel:<?= $patient["Telefoonnummer"] ?>"><?= $patient["Telefoonnummer"] ?></a></td>
        <td><a href="email:<?= $patient["Email"] ?>"><?= $patient["Email"] ?></a></td>
        <td>
            <button><i class="fa-solid fa-pen-to-square"></i>
            </button> <button hx-get="/kookproject/klant-delete/<?= $patient["Klant_ID"] ?>" hx-target=".overlay" onclick="toggle_visabilty()"><i class="fa-solid fa-trash"></i></button>
        </td>
    </tr>
<?php } ?>
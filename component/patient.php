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
        <td><a href="email:<?= $patient["E-mail"] ?>"><?= $patient["E-mail"] ?></a></td>
        <td>
            <button hx-post="/<?= $patient["Klant_ID"] ?>/edit" hx-target=".overlay" onclick="toggle_visabilty()"><i class="fa-solid fa-pen-to-square"></i>
            </button> <button hx-get="/delete/<?= $patient["Klant_ID"] ?>" hx-target=".overlay" onclick="toggle_visabilty()"><i class="fa-solid fa-trash"></i></button>
        </td>
    </tr>
<?php } ?>
<?php
    function planning($planning) {
?>
    <tr>
        <td><?= $planning["Naam_Klant"] ?></td>
        <td><?= $planning["NaamMed"] ?></td>
        <td><?= $planning["Inname_frequentie"] ?></td>
        <td><?= $planning["Datum"] ?></td>
        <td><?= $planning["Tijd"] ?></td>
        <td><?= $planning["Dosering"] ?></td>
        <td><?= $planning["Beperking"] ?></td>
        <td>
            </button> <button hx-get="/kookproject/edit/<?= $planning["Plan_ID"] ?>" hx-target=".overlay" onclick="toggle_visabilty()"><i class="fa-solid fa-pen-to-square"></i></button>
            </button> <button hx-get="/kookproject/delete/<?= $planning["Plan_ID"] ?>" hx-target=".overlay" onclick="toggle_visabilty()"><i class="fa-solid fa-trash"></i></button>
        </td>
    </tr>
<?php } ?>
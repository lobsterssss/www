<?php
$db = new Database;
$user = $db->get_current_user($_SESSION["user"]["klant_id"]);
$db->close();

?>

<!DOCTYPE html>
<html lang="en">
<?php head(); ?>
<body>
<?= navigation(); ?>
    <main>
        <div class="form-container">
            <h1>Settings</h1>
            <form hx-post="./settings" hx-target="#target">
                <p id="target"></p>

                <label for="userName">Naam</label>
                <input name="userName" id="userName" type="text" value="<?= $user["naam"] ?>" placeholder="Naam" required>

                <label for="userLastName">Achter naam</label>
                <input name="userLastName" id="userLastName" type="text" value="<?= $user["achternaam"] ?>" placeholder="Achter naam" required>

                <label for="userEmail">e-mail</label>
                <input name="userEmail" id="userEmail" type="email" value="<?= $user["email"] ?>" placeholder="Email" required>

                <label for="userTel">Telefoon</label>
                <input name="userTel" id="userTel" type="tel" value="<?= $user["telefoon"] ?>" placeholder="Telefoon" minlength="10" required>

                <label for="userAge">leeftijd</label>
                <input name="userAge" id="userAge" type="number" value="<?= $user["leeftijd"] ?>" placeholder="leeftijd" max="120" min="0" >

                <label for="userPlace">woonplaats</label>
                <input name="userPlace" id="userPlace" type="text" value="<?= $user["woonplaats"] ?>" placeholder="woonplaats" >

                <label for="userPost">postcode</label>
                <input name="userPost" id="userPost" type="text" value="<?= $user["postcode"] ?>" placeholder="postcode" minlength="6" >

                <label for="userAdress">adres</label>
                <input name="userTel" id="userTel" type="text" value="<?= $user["adres"] ?>" placeholder="adres" >

                <div>
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </main>
    <?= footer(); ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<?php head(); ?>
<body>
<?= navigation(); ?>
    <main>
        <div class="form-container">
            <h1>Register</h1>
            <form hx-post="./register" hx-target="#target">
                <p id="target"></p>

                <label for="userName">Naam</label>
                <input name="userName" id="userName" type="text" placeholder="Naam" required>

                <label for="userLastName">Achter naam</label>
                <input name="userLastName" id="userLastName" type="text" placeholder="Achter naam" required>

                <label for="userEmail">e-mail</label>
                <input name="userEmail" id="userEmail" type="email" placeholder="Email" required>

                <label for="userTel">Telefoon</label>
                <input name="userTel" id="userTel" type="tel" placeholder="Telefoon" minlength="10" required>

                <label for="userPass">wachtwoord</label>
                <input name="userPass" id="userPass" type="password" placeholder="wachtwoord" required>

                <label for="userPass">re-wachtwoord</label>
                <input name="userrePass" id="userrePass" type="password" placeholder="re-wachtwoord" required>
                <div>
                    <a href="./login">al een acount, login</a>
                    <button type="submit">Registreer</button>
                </div>
            </form>
        </div>
    </main>
    <?= footer(); ?>
</body>
</html>
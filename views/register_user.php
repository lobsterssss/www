<!DOCTYPE html>
<html lang="en">
<?= head(); ?>

    <body>
        <?= navigation(); ?>
        <main>
            <div class="form-container">
                <h2>Register</h2>
                <form hx-post="./register" hx-target="#target">
                    <p id="target"></p>
                    <label for="userName">Naam</label>
                    <input name="userName" id="userName" type="text" placeholder="naam" required>
                    <label for="userEmail">Email</label>
                    <input name="userEmail" id="userEmail" type="email" placeholder="Email" required>
                    <label for="userPass">Password</label>
                    <input name="userPass" id="userPass" type="password" placeholder="Password" required>
                    <label for="re-userPass">Her-Password</label>
                    <input name="re-userPass" id="re-userPass" type="password" placeholder="Password" required>
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
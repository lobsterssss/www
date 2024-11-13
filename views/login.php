<!DOCTYPE html>
<html lang="en">
<?= head(); ?>

    <body>
        <?= navigation(); ?>
        <main>
            <div class="form-container">
                <h2>Login</h2>
                <form hx-post="./login" hx-target="#target">
                    <p id="target"></p>
                    <label for="userEmail">Email</label>
                    <input name="userEmail" id="userEmail" type="email" placeholder="Email">
                    <label for="userPass">Password</label>
                    <input name="userPass" id="userPass" type="password" placeholder="Password">
                    <div>
                        <a href="/register">nog geen acount, registreer</a>
                        <button type="submit">Login</button>
                    </div>
                </form>
            </div>
        </main>
        <?= footer(); ?>
    </body>
</html>
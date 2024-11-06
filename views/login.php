<!DOCTYPE html>
<html lang="en">
<?php head(); ?>

    <body>
        <?= navigation(); ?>
        <main>
            <div>
                <h1>Login</h1>
                <form hx-post="./login" hx-target="#target">
                    <p id="target"></p>
                    <label for="userEmail">Email</label>
                    <input name="userEmail" id="userEmail" type="email" placeholder="Email">
                    <label for="userPass">Password</label>
                    <input name="userPass" id="userPass" type="password" placeholder="Password">
                    <button type="submit">Login</button>
                </form>
            </div>
        </main>
    </body>
</html>
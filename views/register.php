<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<?= navigation(); ?>
    <main>
        <div>
            <h1>Register</h1>
            <form hx-post="/register" hx-target="#target">
                <p id="target"></p>
                <label for="userEmail">e-mail</label>
                <input name="userEmail" id="userEmail" type="email" placeholder="Email">
                <label for="userName">user name</label>
                <input name="userName" id="userName" type="text" placeholder="User Name">
                <label for="userPass">password</label>
                <input name="userPass" id="userPass" type="password" placeholder="Password">
                <button type="submit">Register</button>
            </form>
        </div>
    </main>
</body>
</html>
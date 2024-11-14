
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

                <div>
                    <a href="./login">al een acount, login</a>
                    <button type="submit">Registreer</button>
                </div>
            </form>
        </div>
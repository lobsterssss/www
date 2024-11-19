
        <div class="form-container">
            <h1>Weet uw het zeker</h1>
                <div>
                    <button  onclick="toggle_visabilty()">Ga terug</button>
                    <button hx-post="/kookproject/klant-delete/<?= $Klant_ID ?>" onclick="toggle_visabilty()">Verwijder</button>
                </div>
        </div>

        <div class="form-container">
            <h1>Weet uw het zeker</h1>
                <div>
                    <button  onclick="toggle_visabilty()">ga terug</button>
                    <button hx-post="/delete/<?= $Klant_ID ?>" onclick="toggle_visabilty()">Delete</button>
                </div>
        </div>
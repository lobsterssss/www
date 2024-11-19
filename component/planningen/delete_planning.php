<div class="form-container">
    <h1>Weet uw het zeker</h1>
    <div>
        <button onclick="toggle_visabilty()">Ga terug</button>
        <button hx-post="/kookproject/delete/<?= $Plan_ID ?>" onclick="toggle_visabilty()">Verwijder</button>
    </div>
</div>
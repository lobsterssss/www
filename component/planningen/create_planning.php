<div class="form-container">
    <h1>Create Planning</h1>
    <form hx-post="./create-planning" hx-target="#target">
        <p id="target"></p>

        <label for="klantID">Klant ID</label>
        <input name="klantID" id="klantID" type="number" placeholder="Klant ID" required>

        <label for="medicatie">Medicatie</label>
        <input name="medicatie" id="medicatie" type="text" placeholder="Medicatie" required>

        <label for="innameFrequentie">Inname Frequentie</label>
        <input name="innameFrequentie" id="innameFrequentie" type="text" placeholder="Inname Frequentie" required>

        <label for="datum">Datum</label>
        <input name="datum" id="datum" type="date" required>

        <label for="tijd">Tijd</label>
        <input name="tijd" id="tijd" type="time" required>

        <label for="dosering">Dosering</label>
        <input name="dosering" id="dosering" type="text" placeholder="Dosering" required>

        <label for="beperking">Beperking</label>
        <input name="beperking" id="beperking" type="text" placeholder="Beperking" required>

        <div>
            <button type="submit">Create Planning</button>
        </div>
    </form>
</div>

<div class="form-container" id="planningForm">
    <button class="close-button" onclick="closeForm()">X</button>
    <h1>Create Planning</h1>
    <form hx-post="./create-planning" hx-target="#target">
        <p id="target"></p>

        <!-- Klant Dropdown -->
        <label for="klantID">Klant</label>
        <select name="klantID" id="klantID" required>
            <option value="" disabled selected>Select Klant</option>
            <?php
            $db = new Database;
            $klanten = $db->get_all_user_customers();
            foreach ($klanten as $klant) {
                echo "<option value='{$klant['Klant_ID']}'>{$klant['Naam_Klant']}</option>";
            }
            ?>
        </select>

        <!-- Medicatie Dropdown -->
        <label for="medicatie">Medicatie</label>
        <select name="medicatie" id="medicatie" required>
            <option value="" disabled selected>Select Medicatie</option>
            <?php
            $db = new Database;
            $medicijnen = $db->get_all_medicine();
            foreach ($medicijnen as $medicatie) {
                echo "<option value='{$medicatie['Medi_ID']}'>{$medicatie['NaamMed']}</option>";
            }
            ?>
        </select>

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

<script>
    // JavaScript function to close the popup form
    function closeForm() {
        const formContainer = document.getElementById('planningForm');
        formContainer.style.display = 'none'; // Hides the form
    }
</script>

<style>
    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #f44336;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        font-size: 18px;
        text-align: center;
        cursor: pointer;
    }

    .close-button:hover {
        background: #d32f2f;
    }
</style>
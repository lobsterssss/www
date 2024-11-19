<?php
$db = new Database;
try {
    $planning = $db->get_planning_by_id($Plan_ID);
    if (!$planning) {
        throw new Exception("Planning not found");
    }
} catch (Exception $e) {
    echo "<div class='error'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
    return;
}
?>
<div class="form-container" id="editPlanningForm">
    <button class="close-button" onclick="closeForm()">X</button>
    <h1>Edit Planning</h1>
    <form hx-post="/kookproject/edit/<?= htmlspecialchars($planning['Plan_ID']) ?>" hx-target="#target">
        <p id="target"></p>

        <!-- Klant Dropdown -->
        <label for="klantID">Klant</label>
        <select name="klantID" id="klantID" required>
            <?php
            try {
                $klanten = $db->get_all_user_customers();
                foreach ($klanten as $klant) {
                    $selected = ($klant['Klant_ID'] == $planning['Klant_ID']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($klant['Klant_ID']) . "' {$selected}>" .
                        htmlspecialchars($klant['Naam_Klant']) . "</option>";
                }
            } catch (Exception $e) {
                echo "<option value=''>Error loading klanten</option>";
            }
            ?>
        </select>

        <!-- Medicatie Dropdown -->
        <label for="medicatie">Medicatie</label>
        <select name="medicatie" id="medicatie" required>
            <?php
            try {
                $medicijnen = $db->get_all_medicine();
                foreach ($medicijnen as $medicatie) {
                    $selected = ($medicatie['Medi_ID'] == $planning['Medi_ID']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($medicatie['Medi_ID']) . "' {$selected}>" .
                        htmlspecialchars($medicatie['NaamMed']) . "</option>";
                }
            } catch (Exception $e) {
                echo "<option value=''>Error loading medicatie</option>";
            }
            ?>
        </select>

        <label for="innameFrequentie">Inname Frequentie</label>
        <input name="innameFrequentie" id="innameFrequentie" type="text"
            value="<?= htmlspecialchars($planning['Inname_frequentie']) ?>" required>

        <label for="datum">Datum</label>
        <input name="datum" id="datum" type="date"
            value="<?= htmlspecialchars($planning['Datum']) ?>" required>

        <label for="tijd">Tijd</label>
        <input name="tijd" id="tijd" type="time"
            value="<?= htmlspecialchars($planning['Tijd']) ?>" required>

        <label for="dosering">Dosering</label>
        <input name="dosering" id="dosering" type="text"
            value="<?= htmlspecialchars($planning['Dosering']) ?>" required>

        <label for="beperking">Beperking</label>
        <input name="beperking" id="beperking" type="text"
            value="<?= htmlspecialchars($planning['Beperking']) ?>" required>

        <div>
            <button type="submit">Update Planning</button>
        </div>
    </form>
</div>

<style>
    .error {
        color: #721c24;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 4px;
    }
</style>


<script>
    function closeForm() {
        const formContainer = document.getElementById('editPlanningForm');
        const overlay = document.querySelector('.overlay'); // Selects the overlay

        formContainer.style.display = 'none'; // Hides the form
        if (overlay) {
            overlay.classList.add('hidden'); // Adds the 'hidden' class to hide the overlay
        }
    }
</script>

<script>
    // Get today's date in YYYY-MM-DD format
    const today = new Date().toISOString().split('T')[0];
    // Set the minimum date to today
    document.getElementById('datum').min = today;
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
        width: 50px;
        height: 34px;
        font-size: 18px;
        text-align: center;
        cursor: pointer;
    }

    .close-button:hover {
        background: #d32f2f;
    }
</style>
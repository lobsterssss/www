<?php
require_once 'database/database.php';

// Initialize Database connection
$db = new Database();


// Fetch all patients and medications for the dropdown
$patients = $db->get_all_patients();
$medicijnen = $db->get_all_medicijnen();

// Get existing schedule data
$schedule = $db->get_schedule();

// Get edit record if ID is provided
$editRecord = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $editRecord = $db->get_schedule_by_id($_GET['edit']);
}

?>

<!DOCTYPE html>
<html>
<?php head(); ?>

<body>
    <?php navigation(); ?>

    <div class="container mt-4">
        <!-- Create/Edit Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h3><?php echo $editRecord ? 'Edit Schedule' : 'Create New Schedule'; ?></h3>
            </div>
            <div class="card-body">
                <!-- Updated Form Action to 'create_schedule.php' -->
                <form method="POST" action="./create_schedule">
                    <input type="hidden" name="action" value="<?php echo $editRecord ? 'update' : 'create'; ?>">
                    <?php if ($editRecord): ?>
                        <input type="hidden" name="id" value="<?php echo $editRecord['id']; ?>">
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="patient_id" class="form-label">Patient</label>
                            <select name="patient_id" class="form-control" required>
                                <option value="">Select Patient</option>
                                <?php foreach ($patients as $patient): ?>
                                    <option value="<?php echo htmlspecialchars($patient['patient_id']); ?>"
                                        <?php echo $editRecord && $editRecord['patient_id'] == $patient['patient_id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($patient['patient_naam']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="medicijn_id" class="form-label">Medicijn</label>
                            <select name="medicijn_id" class="form-control" required>
                                <option value="">Select Medicijn</option>
                                <?php
                                foreach ($medicijnen as $medicijn) {
                                    $selected = ($editRecord && $editRecord['medicijn_id'] == $medicijn['medicijn_id']) ? 'selected' : '';
                                    echo "<option value='{$medicijn['medicijn_id']}' {$selected}>{$medicijn['medicijn_naam']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="dosering" class="form-label">Dosering</label>
                            <input type="number" name="dosering" class="form-control"
                                value="<?php echo $editRecord ? $editRecord['dosering'] : ''; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="datum" class="form-label">Datum</label>
                            <input type="date" name="datum" class="form-control"
                                value="<?php echo $editRecord ? $editRecord['datum'] : ''; ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tijdstip" class="form-label">Tijdstip</label>
                            <input type="time" name="tijdstip" class="form-control"
                                value="<?php echo $editRecord ? $editRecord['tijdstip'] : ''; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">
                                <?php echo $editRecord ? 'Update' : 'Create'; ?>
                            </button>
                            <?php if ($editRecord): ?>
                                <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <?php if (isset($_GET['message'])): ?>
            <div class="alert <?php echo $_GET['message'] === 'deleted' ? 'alert-success' : 'alert-danger'; ?>">
                <?php
                echo $_GET['message'] === 'deleted' ? 'Schedule deleted successfully.' : 'Failed to delete schedule.';
                ?>
            </div>
        <?php endif; ?>

        <!-- Schedule Table -->
        <div class="card">
            <div class="card-header">
                <h3>Schedule Overview</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Medicijn</th>
                                <th>Dosering</th>
                                <th>Datum</th>
                                <th>Tijdstip</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($schedule as $row): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['patient_naam']); ?></td>
                                    <td><?php echo htmlspecialchars($row['medicijn_naam']); ?></td> <!-- Use medicijn_naam here -->
                                    <td><?php echo htmlspecialchars($row['dosering']); ?></td>
                                    <td><?php echo htmlspecialchars($row['datum']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tijdstip']); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <!-- Redirecting form submission to delete_schedule.php -->
                                            <form method="POST" action="./delete_schedule" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                <input type="hidden" name="id" value="<?php echo $row['schedule_id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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
                                value="<?php echo $editRecord ? $editRecord['dosering'] : ''; ?>" required  min="1">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="datum" class="form-label">Datum</label>
                            <input type="date" name="datum" id="datum" class="form-control"
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

        <?php
        if (isset($_GET['message'])) {
            switch ($_GET['message']) {
                case 'created':
                    echo "<p>Schedule created successfully.</p>";
                    break;
                case 'updated':
                    echo "<p>Schedule updated successfully.</p>";
                    break;
                case 'update_failed':
                    echo "<p>Failed to update schedule.</p>";
                    break;
                case 'deleted':
                    echo "<p>Schedule deleted successfully.</p>";
                    break;
                case 'delete_failed':
                    echo "<p>Failed to delete schedule.</p>";
                    break;
                case 'create_failed':
                    echo "<p>Failed to create schedule.</p>";
                    break;
                case 'invalid_date':
                    echo "<p>Cannot select a past date.</p>";
                    break;
                    // Add other cases as needed
                default:
                    echo "<p>Unknown action.</p>";
                    break;
            }
        }
        ?>


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
                                    <td><?php echo htmlspecialchars($row['medicijn_naam']); ?></td>
                                    <td><?php echo htmlspecialchars($row['dosering']); ?></td>
                                    <td><?php echo htmlspecialchars($row['datum']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tijdstip']); ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <form method="POST" action="./delete_schedule" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                <input type="hidden" name="id" value="<?php echo $row['schedule_id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editScheduleModal" data-id="<?php echo $row['schedule_id']; ?>">
                                                Edit
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="modal fade" id="editScheduleModal" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="/kookproject/update_schedule">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editScheduleModalLabel">Edit Schedule</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="edit-schedule-id">
                                        <div class="mb-3">
                                            <label for="edit-patient-id" class="form-label">Patient</label>
                                            <select name="patient_id" id="edit-patient-id" class="form-control" required>
                                                <?php foreach ($patients as $patient): ?>
                                                    <option value="<?php echo htmlspecialchars($patient['patient_id']); ?>"><?php echo htmlspecialchars($patient['patient_naam']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-medicijn-id" class="form-label">Medicijn</label>
                                            <select name="medicijn_id" id="edit-medicijn-id" class="form-control" required>
                                                <?php foreach ($medicijnen as $medicijn): ?>
                                                    <option value="<?php echo htmlspecialchars($medicijn['medicijn_id']); ?>"><?php echo htmlspecialchars($medicijn['medicijn_naam']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-dosering" class="form-label">Dosering</label>
                                            <input type="number" name="dosering" id="edit-dosering" class="form-control" required  min="1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-datum" class="form-label">Datum</label>
                                            <input type="date" name="datum" id="edit-datum" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit-tijdstip" class="form-label">Tijdstip</label>
                                            <input type="time" name="tijdstip" id="edit-tijdstip" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set minimum date to today's date
            const today = new Date().toISOString().split('T')[0];

            // Set for Create Form
            const createDateInput = document.querySelector('input[name="datum"]');
            if (createDateInput) {
                createDateInput.setAttribute('min', today);
            }

            // Set for Edit Form in Modal
            const editDateInput = document.getElementById('edit-datum');
            if (editDateInput) {
                editDateInput.setAttribute('min', today);
            }

            // Populate edit modal data on click
            document.querySelectorAll('button[data-bs-target="#editScheduleModal"]').forEach(button => {
                button.addEventListener('click', function() {
                    const scheduleId = button.getAttribute('data-id');
                    fetch(`./get_schedule_data?id=${scheduleId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('edit-schedule-id').value = data.id;
                            document.getElementById('edit-patient-id').value = data.patient_id;
                            document.getElementById('edit-medicijn-id').value = data.medicijn_id;
                            document.getElementById('edit-dosering').value = data.dosering;
                            document.getElementById('edit-datum').value = data.datum;
                            document.getElementById('edit-tijdstip').value = data.tijdstip;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error loading schedule data: ' + error.message);
                        });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById("datum").setAttribute('min', today);
        });
    </script>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
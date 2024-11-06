<!DOCTYPE html>
<html>

<?php
head();
?>

<body>
    <?php

    navigation();

    $schedule = new Database();
    $schema = $schedule->get_schedule();


    ?>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table" id="searchTable">
                <thead>
                    <tr>
                        <th scope="col">Patient</th>
                        <th scope="col">Medicijn</th>
                        <th scope="col">Dosering</th>
                        <th scope="col">Datum</th>
                        <th scope="col">Tijdstip</th>
                        <th scope="col">Bewerken</th>
                        <th scope="col">Verwijderen</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Static Data Row 1 -->
                    <tr>
                        <td> <select>
                                <option value="optionText1">
                                    Option Text 1
                                </option>
                                <option value="optionText2">
                                    Option Text 2
                                </option>
                                <option value="optionText3">
                                    Option Text 3
                                </option>
                            </select></td>
                        <td><select>
                                <option value="optionText1">
                                    Option Text 1
                                </option>
                                <option value="optionText2">
                                    Option Text 2
                                </option>
                                <option value="optionText3">
                                    Option Text 3
                                </option>
                            </select></td>
                        <td><input type="number" name="number" value="" /></td>
                        <td>
                            <input type="date" class="form-control" name="lesbloktijdeind" required>
                        </td>
                        <td>
                            <input type="time" class="form-control" name="lesbloktijdeind" required>
                        </td>
                        <td><a href="update.php?id=1" class="btn btn-success">Bewerken</a></td>
                        <td>
                            <form action="../core/delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this car?')">
                                <input type="hidden" name="auto_id" value="1">
                                <button type="submit" class="btn btn-danger">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Static Data Row 2 -->
                    <tr>
                        <td> <select>
                                <option value="optionText1">
                                    Option Text 1
                                </option>
                                <option value="optionText2">
                                    Option Text 2
                                </option>
                                <option value="optionText3">
                                    Option Text 3
                                </option>
                            </select></td>
                        <td><select>
                                <option value="optionText1">
                                    Option Text 1
                                </option>
                                <option value="optionText2">
                                    Option Text 2
                                </option>
                                <option value="optionText3">
                                    Option Text 3
                                </option>
                            </select></td>
                        <td><input type="number" name="number" value="" /></td>
                        <td>
                            <input type="date" class="form-control" name="lesbloktijdeind" required>
                        </td>
                        <td>
                            <input type="time" class="form-control" name="lesbloktijdeind" required>
                        </td>
                        <td><a href="update.php?id=1" class="btn btn-success">Bewerken</a></td>
                        <td>
                            <form action="../core/delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this car?')">
                                <input type="hidden" name="auto_id" value="1">
                                <button type="submit" class="btn btn-danger">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
                <div id="noResultsMessage" style="display: none;">Geen Auto's gevonden.</div>
            </table>
        </div>

        <!-- Create auto button (optional) -->
        <div class="row justify-content-end mb-3">
            <div class="col-auto">
                <a href="create.php">
                    <button type="submit" class="btn btn-primary">Aanmaken</button>
                </a>
            </div>
        </div>
    </div>

    <div class="table-container">
        <!-- First Table (Existing Static Content) -->
        <div class="table-responsive">
            <table class="table" id="searchTable">
                <thead>
                    <tr>
                        <th scope="col">Patient</th>
                        <th scope="col">Medicijn</th>
                        <th scope="col">Dosering</th>
                        <th scope="col">Datum</th>
                        <th scope="col">Tijdstip</th>
                        <th scope="col">Bewerken</th>
                        <th scope="col">Verwijderen</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Static rows -->
                    <!-- Replace or modify as needed -->
                </tbody>
            </table>
        </div>

        <!-- Second Table (Dynamic Content from Schedule) -->
        <div class="table-responsive">
            <h3>Schedule</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Patient</th>
                        <th scope="col">Medicijn</th>
                        <th scope="col">Dosering</th>
                        <th scope="col">Datum</th>
                        <th scope="col">Tijdstip</th>
                        <th scope="col">Bewerken</th>
                        <th scope="col">Verwijderen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Loop through each schedule item and display in a table row
                    foreach ($schedule as $row) {
                        echo "<tr>
                                    <td>{$row['patient_id']}</td>
                                    <td>{$row['medicatie']}</td>
                                    <td>{$row['dosering']}</td>
                                    <td>{$row['datum']}</td>
                                    <td>{$row['tijdstip']}</td>
                                    <td><a href='update.php?id={$row['id']}' class='btn btn-success'>Bewerken</a></td>
                                    <td>
                                        <form action='../core/delete.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this item?\")'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <button type='submit' class='btn btn-danger'>Verwijderen</button>
                                        </form>
                                    </td>
                                  </tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
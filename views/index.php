<!DOCTYPE html>
<html>


<body>
    <?php navigation(); ?>

    <div>
        <img src="" alt="logo placeholder" style="width:20%;height:20%;" class="center">
    </div>

    <div>

        <b>
            <h1>Welkom bij MediTurn!</h1>
            <p>Herinneringen op tijd, voor uw gezondheid.</p>
            <?php
            head();

            // Add this section to check database connection
            $connectionStatus = "";
            try {
                $db = new Database();
                $connectionStatus = '<div class="alert alert-success">Database connection successful!</div>';
            } catch (Exception $e) {
                $connectionStatus = '<div class="alert alert-danger">Database connection failed: ' . $e->getMessage() . '</div>';
            }
            ?>
            <?php echo $connectionStatus; ?>
        </b>
    </div>

    <div class="card-container">
        <a href="placeholder.txt.html" class="vertical-card">
            <img src="" alt="MediTurn machine" class="card_img" style="width:40%; height: auto;">
            <h1 class="drugs">MediTurn machine</h1>
            <p class="info">
                info over MediTurn machine
            </p>
        </a>
    </div>
</body>

</html>
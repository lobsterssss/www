<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/css/style.css"> 
    <title>MediTurn</title>
    <script>

        function searchDrugs(event) {
            event.preventDefault(); // Prevent the form from submitting
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            alert(`Searching for: ${searchTerm}`); // Placeholder for search functionality
        }
    </script>
</head>

<body>
<?php

    navigation();

?>

    <div>
        <img src="" alt="logo placeholder" style="width:20%;height:20%;" class="center">
    </div>

    <div>
        <b>
            <h1>Welkom bij MediTurn!</h1>
            <p> Herinneringen op tijd, voor uw gezondheid.</p>
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

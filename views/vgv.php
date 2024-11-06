<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"> 
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


	<div class="about-section">
		<h2>Veelgestelde vragen</h2>
		<p class="AS">  </p>
			
			</li>
		</ul>
	</div>

</body>

</html>
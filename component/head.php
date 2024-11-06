<?php
    function head() {
?>
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
<?php } ?>
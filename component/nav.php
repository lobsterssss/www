<?php
    function navigation() {
?>
<header>
		<form class="sb" onsubmit="searchDrugs(event)" style="display: flex; align-items: center;">
			<input type="text" id="searchInput" class="searchbar" placeholder="mmm drugs..." name="search" style="padding: 10px; width: 50%; margin-left: 80px;">
			<button type="submit" class="sbtn">Zoeken</button> 
		</form>
	
		<div class="MediTurn" style="margin-right: 90px;">
			<b>MediTurn</b>
		</div>
		<ul class="menu">
			<li><a href="/kookproject">Home</a></li>
            <li><a href="./medicijnen">Medicijnen</a></li>
			<li><a href="./database">Database</a></li>
			<li><a href="./about">Over ons</a></li>
			<li><a href="./contact">Contact</a></li>
		</ul>
	</header>	<?php } ?>
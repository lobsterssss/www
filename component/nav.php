<?php
    function navigation() {
?>
	<nav>
		<a href="/">
			<div>
				<img src="/public/img/logo.png" alt="logo">
				<h1>MediTurn</h1>
			</div>
		</a>
		<ul>
			<a href="/"><li><p>Home</p></li></a>
			<a href="/about"><li><p>Over ons</p></li></a>
			<?php 
			if(!isset($_SESSION["user"])):
			?>
				<a href="/login"><li><p>Login</p></li></a>
			<?php
			else:
				?>
				<li class="dropdown">
				<span><?= $_SESSION["user"]["naam"] ?></span>
					<ul class="dropdown-content">
					<a><li><p>settings</p></li></a>
					<a href="/logout"><li><p>logout</p></li></a>
					</ul>
				</li>

			<?php
				endif;
			?>
		</ul>
	</nav>
<?php } ?>
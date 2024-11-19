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
			<a href="/kookproject"><li><p>Home</p></li></a>
			<a href="/kookproject/about"><li><p>Over ons</p></li></a>
			<?php 
			if(!isset($_SESSION["user"])):
			?>
				<a href="/kookproject/login"><li><p>Login</p></li></a>
			<?php
			else:
				?>
				<li class="dropdown">
				<span><?= $_SESSION["user"]["GB"] ?></span>
					<ul class="dropdown-content">
						<a href="/kookproject/patienten">
							<li>
								<p>patienten</p>
							</li>
						</a>
						<a href="/kookproject/planningen">
							<li>
								<p>planningen</p>
							</li>
						</a>
						<a href="/kookproject/logout">
							<li>
								<p>logout</p>
							</li>
						</a>
					</ul>
				</li>

			<?php
				endif;
			?>
		</ul>
	</nav>
<?php } ?>
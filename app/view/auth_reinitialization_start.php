<?php
	$login = urldecode($_GET['login']);

	if (filter_var($login, FILTER_VALIDATE_EMAIL))
		$message = $login;
	else
		$message = "to the email associated with the username " . $login;
?>

<div id="auth">

	<h1 class="logo">CraftyPic</h1>

	<div id="window-reinitialization-start" class="window">
		<p class="window-title">Forgot password</p>
		<p class="window-message">An account validation email has been sent to <?php echo $message ?>. Please check your inbox to activate it.</p>
		<button class="window-button login-redirection-button">
			Log in
		</button>
	</div>

</div>
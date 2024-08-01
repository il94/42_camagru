<?php
	$email = urldecode($_GET['email']);
?>

<div class="page">
<div id="settings">

	<div class="window">
		<form id="form-forgot-password" class="window-form">

			<div id="window-reinitialization-start" class="window">

				<button class="button-icon window-return-button settings-redirection-button" type="button">
					<?php require ("view/assets/icons/return.svg"); ?>
				</button>

				<p class="window-title">Forgot password</p>
				<p class="window-message">An account validation email has been sent to <?php echo $email ?>. Please check your inbox to activate it.</p>
				<button class="window-button settings-redirection-button" type="button">
					Done
				</button>
			</div>

			<p id="logout-button" class="window-redirect window-input-link">Logout</p> 
		</form>
	</div>

</div>
</div>
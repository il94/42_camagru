<div class="page">
<div id="settings">

	<div class="window">
		<form id="form-email" name="email" class="window-form">

			<button class="button-icon window-return-button settings-redirection-button" type="button">
				<?php require ("view/assets/icons/return.svg"); ?>
			</button>

			<p class="window-title">Change email</p>

			<div id="email-field" class="window-field">
				<div class="window-input">
					<span class="window-input-placeholder">Email</span>
					<input id="email-value" class="window-input-text" value="<?php echo $user->email; ?>" type="text"></input>
				</div>
			</div>

			<p class="window-error-message"></p>

			<button class="window-button" type="submit">
				Next
			</button>
			
		</form>
	</div>

</div>
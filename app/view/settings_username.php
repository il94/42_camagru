<div id="settings">

	<div class="window">
		<form id="form-username" name="username" class="window-form">

			<button class="button-icon window-return-button settings-redirection-button" type="button">
				<?php require ("view/assets/icons/return.svg"); ?>
			</button>

			<p class="window-title">Change username</p>

			<div id="username-field" class="window-field">
				<div class="window-input">
					<span class="window-input-placeholder">Username</span>
					<input id="username-value" class="window-input-text" value="<?php echo $user->username; ?>" type="text"></input>
				</div>
			</div>

			<p class="window-error-message"></p>

			<button class="window-button" type="submit">
				Done
			</button>
			
		</form>
	</div>

</div>
<div id="auth">

	<h1 class="logo">CraftyPic</h1>

	<div class="window">
		<form id="form-reinitialization" class="window-form">

			<p class="window-title">Reinitialize password</p>

			<div id="password-field" class="window-field">
				<div id="password-window-input" class="window-input">
					<span class="window-input-placeholder">New password</span>
					<input id="password-value" class="window-input-text" type="password"></input>
					<button class="show-button button-icon" type="button">
						<?php require ("view/assets/icons/show.svg"); ?>
						<?php require ("view/assets/icons/hidden.svg"); ?>
					</button>
				</div>
			</div>
			<div id="re-type-password-field" class="window-field">
				<div id="re-type-password-window-input" class="window-input">
					<span class="window-input-placeholder">Re-type new password</span>
					<input id="re-type-password-value" class="window-input-text" type="password"></input>
					<button class="show-button button-icon" type="button">
						<?php require ("view/assets/icons/show.svg"); ?>
						<?php require ("view/assets/icons/hidden.svg"); ?>
					</button>
				</div>
			</div>

			<p class="window-error-message"></p>

			<button class="window-button" type="submit">
				Done
			</button>

		</form>
	</div>

</div>
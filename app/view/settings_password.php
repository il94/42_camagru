<div id="settings">

	<div class="window">
		<form class="window-form">

			<button id="return-settings" class="button-icon window-return-button" type="button">
				<?php require ("view/assets/icons/return.svg"); ?>
			</button>

			<p class="window-title">Change password</p>

			<div id="current-password-field" class="window-field">
				<div class="window-input">
					<span class="window-input-placeholder">Current password</span>
					<input id="current-password-value" class="window-input-text" type="password"></input>
					<button class="show-button button-icon" type="button">
						<?php require ("view/assets/icons/show.svg"); ?>
						<?php require ("view/assets/icons/hidden.svg"); ?>
					</button>
				</div>
				<a href="/?page=auth&route=login&state=forgot-password" class="window-input-link">Forgot your password ?</a>
			</div>

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
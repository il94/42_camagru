<div id="auth">

	<h1 class="logo">CraftyPic</h1>

	<div class="window">
		<form id="form-signup" class="window-form">

			<p class="window-title random"></p>

			<div id="email-field" class="window-field">
				<div id="email-window-input" class="window-input">
					<span class="window-input-placeholder">Email</span>
					<input id="email-value" class="window-input-text" type="text"></input>
				</div>
			</div>
			<div class="window-field">
				<div id="username-window-input" class="window-input">
					<span class="window-input-placeholder">Username</span>
					<input id="username-value" class="window-input-text" type="text"></input>
				</div>
			</div>

			<div id="password-field" class="window-field">
				<div id="password-window-input" class="window-input">
					<span class="window-input-placeholder">Password</span>
					<input id="password-value" class="window-input-text" type="password"></input>
					<button class="show-button button-icon" type="button">
						<?php require ("view/assets/icons/show.svg"); ?>
						<?php require ("view/assets/icons/hidden.svg"); ?>
					</button>
				</div>
			</div>
			<div id="re-type-password-field" class="window-field">
				<div id="re-type-password-window-input" class="window-input">
					<span class="window-input-placeholder">Re-type password</span>
					<input id="re-type-password-value" class="window-input-text" type="password"></input>
					<button class="show-button button-icon" type="button">
						<?php require ("view/assets/icons/show.svg"); ?>
						<?php require ("view/assets/icons/hidden.svg"); ?>
					</button>
				</div>
			</div>

			<p class="window-error-message"></p>

			<button class="window-button" type="submit">
				Sign up
			</button>

			<p class="window-redirect">Have an account ? <a href="/?page=auth&route=login">Log in</a></p> 
			<p class="window-redirect guest">Or continue as <a href="/?page=home_guest">guest</a></p>
		</form>
	</div>

</div>
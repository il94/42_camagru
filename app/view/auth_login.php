<div id="auth">

	<h1 class="logo">CraftyPic</h1>

	<div class="window">
		<form id="form-login" class="window-form">

			<p class="window-title random"></p>

			<div id="login-field" class="window-field">
				<div class="window-input">
					<span class="window-input-placeholder">Email or username</span>
					<input id="login-value" class="window-input-text" type="text"></input>
				</div>
			</div>

			<div id="password-field"  class="window-field">
				<div class="window-input">
					<span class="window-input-placeholder">Password</span>
					<input id="password-value" class="window-input-text" type="password"></input>
					<button class="show-button button-icon" type="button">
						<?php require ("view/assets/icons/show.svg"); ?>
						<?php require ("view/assets/icons/hidden.svg"); ?>
					</button>
				</div>
				<a href="/?page=auth&route=login&state=forgot-password" class="window-input-link">Forgot your password ?</a>
			</div>

			<p class="window-error-message"></p>

			<button class="window-button" type="submit">
				Log in
			</button>

			<p class="window-redirect" >Don't have an account ? <a href="/?page=auth&route=signup">Sign up</a></p> 
			<p class="window-redirect guest">Or continue as <a href="/?page=home_guest">guest</a></p>
		</form>
	</div>
</div>
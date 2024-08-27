<div id="auth">

	<h1 class="logo">CraftyPic</h1>

	<div class="window">

		<button class="button-icon window-return-button">
			<?php require ("view/assets/icons/return.svg"); ?>
		</button>

		<form id="form-forgot-password" class="window-form">

			<p class="window-title">Forgot password</p>

			<p class="window-message">Enter your email, or username and we'll send you a link to reinitialize your password.</p>

			<div id="login-field" class="window-field">
				<div class="window-input">
					<span class="window-input-placeholder">Email or username</span>
					<input id="login-value" class="window-input-text" type="text"></input>
				</div>
			</div>

			<p class="window-error-message"></p>

			<button class="window-button" type="submit">
				Send
			</button>

			<p class="window-redirect" >Don't have an account ? <a href="/signup">Sign up</a></p> 

		</form>
	</div>
</div>
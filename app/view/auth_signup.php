<div id="auth">

	<h1 class="logo">CraftyPic</h1>

	<form id="form-signup" class="form">

		<p class="form-title">It's an honor, Your Excellency.</p>

		<div id="email-field" class="form-field">
			<div id="email-input" class="input">
				<span class="input-placeholder">Email</span>
				<input id="email-value" class="input-text" type="text"></input>
			</div>
		</div>
		<div class="form-field">
			<div id="username-input" class="input">
				<span class="input-placeholder">Username</span>
				<input id="username-value" class="input-text" type="text"></input>
			</div>
		</div>

		<div id="password-field" class="form-field">
			<div id="password-input" class="input">
				<span class="input-placeholder">Password</span>
				<input id="password-value" class="input-text" type="password"></input>
				<button class="show-button button-icon" type="button">
					<?php require ("view/assets/icons/show.svg"); ?>
					<?php require ("view/assets/icons/hidden.svg"); ?>
				</button>
			</div>
		</div>
		<div id="re-type-password-field" class="form-field">
			<div id="re-type-password-input" class="input">
				<span class="input-placeholder">Re-type password</span>
				<input id="re-type-password-value" class="input-text" type="password"></input>
				<button class="show-button button-icon" type="button">
					<?php require ("view/assets/icons/show.svg"); ?>
					<?php require ("view/assets/icons/hidden.svg"); ?>
				</button>
			</div>
		</div>

		<p class="form-error-message"></p>

		<button class="form-button" type="submit">
			Sign up
		</button>

		<p class="form-redirect">Have an account ? <a href="/?page=auth&route=login">Log in</a></p> 

	</form>
</div>
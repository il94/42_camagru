<div id="auth">

	<h1 class="logo">CraftyPic</h1>

	<form class="form">

		<p class="form-title">It's an honor, Your Excellency.</p>

		<div class="form-field">
			<div class="input">
				<span class="input-placeholder">Email</span>
				<input class="input-text" type="text"></input>
			</div>
		</div>
		<div class="form-field">
			<div class="input">
				<span class="input-placeholder">Username</span>
				<input class="input-text" type="text"></input>
			</div>
		</div>

		<div class="form-field">
			<div class="input">
				<span class="input-placeholder">Password</span>
				<input class="input-text" type="password"></input>
				<button class="show-button button-icon" type="button">
					<?php require ("view/assets/icons/show.svg"); ?>
					<?php require ("view/assets/icons/hidden.svg"); ?>
				</button>
			</div>
		</div>
		<div class="form-field">
			<div class="input">
				<span class="input-placeholder">Re-type password</span>
				<input class="input-text" type="password"></input>
				<button class="show-button button-icon" type="button">
					<?php require ("view/assets/icons/show.svg"); ?>
					<?php require ("view/assets/icons/hidden.svg"); ?>
				</button>
			</div>
		</div>

		<p class="form-error-message">Temp</p>

		<button class="form-button" type="submit">
			Sign up
		</button>

		<p class="form-redirect">Have an account ? <a href="/?page=auth&route=login">Log in</a></p> 

	</form>
</div>
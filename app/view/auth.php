<div id="auth">

	<h1 class="logo">CraftyPic</h1>

	<form class="form">

		<p class="form-title">Welcome back, Master.</p>

		<div class="form-field">
			<div class="input">
				<span class="input-placeholder">Email or username</span>
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
			<a href="recover-password" class="input-link">Forgot your password ?</a>
		</div>

		<p class="form-error-message">Temp</p>

		<button class="form-button" type="submit">
			Log in
		</button>

		<p class="form-redirect" >Don't have an account ? <a href="signup">Sign up</a></p> 

	</form>
</div>
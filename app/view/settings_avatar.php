<div class="page">
<div id="settings">

	<div class="window">
		<form id="form-avatar" class="window-form" enctype="multipart/form-data">

			<button class="button-icon window-return-button settings-redirection-button" type="button">
				<?php require ("view/assets/icons/return.svg"); ?>
			</button>

			<p class="window-title">Change avatar</p>

			<div class="window-avatar">
				<label for="input-file">
					<img id="avatar-field" class="window-field-avatar" src="<?php echo $user->avatar; ?>"/>
				</label>
				<input type="file" id="input-file" accept="image/png, image/jpg, image/jpeg, image/gif, image/webp" />
			</div>

			<p class="window-error-message"></p>

			<button class="window-button" type="submit">
				Done
			</button>	
			
			<p id="logout-button" class="window-redirect window-input-link">Logout</p> 
		</form>
	</div>

</div>
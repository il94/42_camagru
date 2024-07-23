<div id="settings">

	<div class="window">
		<form id="form-avatar" class="window-form" enctype="multipart/form-data">

			<button class="button-icon window-return-button settings-redirection-button" type="button">
				<?php require ("view/assets/icons/return.svg"); ?>
			</button>

			<p class="window-title">Change avatar</p>

			<div class="window-avatar">
				<label for="file-input">
					<img id="avatar-field" class="window-field-avatar" src="<?php echo $user->avatar; ?>"/>
				</label>
				<input type="file" id="file-input" accept="image/*"/>
			</div>

			<p class="window-error-message"></p>

			<button class="window-button" type="submit">
				Done
			</button>
			
		</form>
	</div>

</div>
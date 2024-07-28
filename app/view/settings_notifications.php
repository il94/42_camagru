<div class="page">
<div id="settings">

	<div class="window">
		<form id="form-notifications" class="window-form">

			<button class="button-icon window-return-button settings-redirection-button" type="button">
				<?php require ("view/assets/icons/return.svg"); ?>
			</button>

			<p class="window-title">Notification preferences</p>

			<div class="window-switch-list">

				<div class="window-switch-list-header">
					<p class="window-switch-list-title">Email</p>
				</div>

				<div class="window-switch-container">
					<p>Likes</p>
					<label class="switch">
						<input id="notification-like-input" type="checkbox" <?php echo $user->notification_like ?  "checked" : ''; ?>>
						<span class="slider round"></span>
					</label>
				</div>
				
				<div class="window-switch-container">
					<p>Comments</p>
					<label class="switch">
						<input id="notification-like-comment" type="checkbox" <?php echo $user->notification_comment ?  "checked" : ''; ?>>
						<span class="slider round"></span>
					</label>
				</div>

			</div>
			
		</form>
	</div>

</div>
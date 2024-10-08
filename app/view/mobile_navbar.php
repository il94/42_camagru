<!-- MOBILE NAVBAR -->

<div class="mobile-navbar">
	<button id="mobile-home-button" class="button-icon selectable">
		<?php require ("view/assets/icons/home.svg"); ?>
	</button>
	<button class="button-icon selectable create-button">
		<?php require ("view/assets/icons/add.svg"); ?>
	</button>
	<button id="mobile-logout-button" class="button-icon">
		<?php require ("view/assets/icons/logout.svg"); ?>
	</button>
	<?php if (!$user): ?>
		<button class="auth-button button-icon selectable">
			<?php require('uploads/default_avatar.svg'); ?>
		</button>
	<?php else: ?>
	<button id="mobile-profile-button" class="button-icon selectable">
		<?php
			if (!$user)
				echo file_get_contents("/var/www/html/uploads/default_avatar.svg");
			else if (endsWith($user->avatar, '.svg'))
				echo file_get_contents("/var/www/html" . $user->avatar);
			else 
				echo "<img src='" . htmlspecialchars($user->avatar, ENT_QUOTES, 'UTF-8') . "' />";
		?>
	</button>
	<?php endif ?>
</div>
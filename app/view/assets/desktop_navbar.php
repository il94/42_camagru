<div class="desktop-navbar">
	<button id="logo" class="logo">CraftyPic</button>
	<div id="desktop-navbar-icons">
		<button id="logout-hidden-button" class="button-icon">
			<?php require ("view/assets/icons/logout.svg"); ?>
		</button>
		<button id="profile-button" class="button-icon selectable">
			<?php
				if (!$user)
					echo file_get_contents("/var/www/html/uploads/default_avatar.svg");
				else if (endsWith($user->avatar, '.svg'))
					echo file_get_contents("/var/www/html" . $user->avatar);
				else 
					echo "<img src='" . htmlspecialchars($user->avatar, ENT_QUOTES, 'UTF-8') . "' />";
			?>
		</button>
	</div>
</div>
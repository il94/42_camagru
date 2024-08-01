<div id="angle-popup">
	<div id="angle-popup-profile">
		<p id="angle-popup-title">Hi, <span id="angle-popup-title-username"><?php echo $user->username; ?> !</span></p>
		<div id="angle-popup-content">
			<button class="section create-button">
				<?php require ("view/assets/icons/gallery.svg"); ?>
				<p>Craft a new pic !</p>
			</button>
			<button id="settings-button" class="section">
				<?php require ("view/assets/icons/settings.svg"); ?>
				<p>Settings account</p>
			</button>
			<button id="logout-button" class="section">
				<?php require ("view/assets/icons/logout.svg"); ?>
				<p>Logout</p>
			</button>
		</div>
	</div>
</div>
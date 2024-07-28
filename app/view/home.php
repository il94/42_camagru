<!-- DESKTOP NAVBAR -->

<div class="desktop-navbar">
	<button id="logo" class="logo">CraftyPic</button>
	<div id="desktop-navbar-icons">
		<!-- <button id="loop-button" class="button-icon selectable">
			<?php require ("view/assets/icons/loop.svg"); ?>
		</button>
		<button id="notification-button" class="button-icon selectable">
			<?php require ("view/assets/icons/notification.svg"); ?>
		</button> -->
		<button id="logout-hidden-button" class="button-icon">
			<?php require ("view/assets/icons/logout.svg"); ?>
		</button>
		<button id="profile-button" class="button-icon selectable">
			<?php
				if (endsWith($user->avatar, '.svg'))
					echo file_get_contents($user->avatar);
				else 
					echo "<img src='" . htmlspecialchars($user->avatar, ENT_QUOTES, 'UTF-8') . "' />";
			?>
		</button>
	</div>
</div>

<!-- MAIN -->

<div class="main">

	<!-- FEED -->

	<div id="feed" userId="<?php echo $user->id; ?>" username="<?php echo $user->username; ?>" avatar="<?php echo $user->avatar; ?>">

		<!-- FEED HEADER -->

		<div id="feed-header-container">
			<div id="feed-header">
				<button id="feed-header-button-foryou" class="feed-header-button">
					For you
				</button>
				<!-- <button id="feed-header-button-following" class="feed-header-button">
					Following
				</button> -->
			</div>
		</div>

		<!-- CREATE BUTTON -->

		<?php require ($createButton); ?>

		<!-- PICS -->

		<div id="pics-container"></div>
		<div id="refetch-pics-observer"></div>

	</div>

	<!-- ANGLE POPUP -->

	<div id="angle-popup">
		<div id="angle-popup-profile">
			<p id="angle-popup-title">Hi, <span id="angle-popup-title-username">Lorem ipsum !</span></p>
			<div id="angle-popup-content">
				<!-- <button class="section">
					<?php require ("view/assets/icons/gallery.svg"); ?>
					<p>Your pics</p>
				</button> -->
				<!-- <button class="section">
					<?php require ("view/assets/icons/moon.svg"); ?>
					<p>Dark mode</p>
				</button> -->
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
		<!-- <div id="angle-popup-notification">
			<p id="angle-popup-title">Notifications</p>
			<div id="angle-popup-content">
			<div class="notification">
				<img src="temp/pic_example_3.jpg">
				<p>Lorem ipsum liked your pic !</p>
			</div>

			<div class="notification">
				<img src="temp/pic_example_3.jpg">
				<p>Lorem ipsum commented your pic : “Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod”.</p>
			</div>
		</div> -->
	</div>

	<!-- DELETE POPUP -->

	<div id="delete-popup" class="window">
		<form id="delete-pic-form" class="window-form">

			<button id="close-delete-popup" class="button-icon window-return-button" type="button">
				<?php require ("view/assets/icons/return.svg"); ?>
			</button>
			
			<p class="window-title">Remove this pic ?</p>
			<p class="window-message">This act is not reversible. Are you sure ?</p>
			
			<button id="delete-button" class="window-button red">Remove</button>
			
		</form>
	</div>
</div>

<!-- MOBILE NAVBAR -->

<div class="mobile-navbar">
	<button class="button-icon selectable">
		<?php require ("view/assets/icons/home.svg"); ?>
	</button>
	<!-- <button id="loop-button" class="button-icon selectable">
		<?php require ("view/assets/icons/loop.svg"); ?>
	</button> -->
	<button class="button-icon selectable">
		<?php require ("view/assets/icons/add.svg"); ?>
	</button>
	<!-- <button class="button-icon selectable">
		<?php require ("view/assets/icons/notification.svg"); ?>
	</button> -->
	<button class="button-icon selectable">
		<?php require ("view/assets/icons/profile.svg"); ?>
	</button>
</div>
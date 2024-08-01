<!-- DESKTOP NAVBAR -->

<div class="desktop-navbar">
	<button id="logo" class="logo">CraftyPic</button>
	<div id="desktop-navbar-icons">
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

<!-- PAGE -->

<div class="page">

	<!-- FEED -->

	<div id="feed" userId="<?php echo $user->id; ?>" username="<?php echo $user->username; ?>" avatar="<?php echo $user->avatar; ?>">

		<!-- FEED HEADER -->

		<div id="feed-header-container">
			<div id="feed-header">
				<button id="feed-header-button-foryou" class="feed-header-button">
					For you
				</button>
			</div>
		</div>

		<!-- CREATE BUTTON -->

		<?php require ($createButton); ?>

		<!-- PICS -->

		<div id="pics-container"></div>
		<div id="refetch-pics-observer"></div>

	</div>

	<!-- ANGLE POPUP -->

	<?php require("view/assets/angle_popup.php") ?>

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

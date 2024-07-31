<!-- DESKTOP NAVBAR -->

<div class="desktop-navbar">
	<button id="logo" class="logo">CraftyPic</button>
	<div id="desktop-navbar-icons">
		<button class="auth-button button-icon selectable">
			<?php require('uploads/default_avatar.svg'); ?>
		</button>
	</div>
</div>

<!-- PAGE -->

<div class="page">

	<!-- FEED -->

	<div id="feed">

		<!-- FEED HEADER -->

		<div id="feed-header-container">
			<div id="feed-header">
				<button id="feed-header-button-foryou" class="feed-header-button">
					For you
				</button>
			</div>
		</div>

		<!-- PICS -->

		<div id="pics-container"></div>
		<div id="refetch-pics-observer"></div>

	</div>
</div>
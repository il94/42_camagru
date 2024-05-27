<!-- DESKTOP NAVBAR -->

<div class="desktop-navbar">
	<button id="desktop-navbar-logo">CraftyPic</button>
	<div id="desktop-navbar-icons">
		<button id="loop-button" class="button-icon selectable">
			<?php require ("view/assets/icons/loop.svg"); ?>
		</button>
		<button id="notification-button" class="button-icon selectable">
			<?php require ("view/assets/icons/notification.svg"); ?>
		</button>
		<button id="profile-button" class="button-icon selectable">
			<?php require ("view/assets/icons/profile.svg"); ?>
		</button>
	</div>
</div>

<!-- MAIN -->

<div class="main">

	<!-- FEED -->

	<div id="feed">

		<!-- FEED HEADER -->

		<div id="feed-header-container">
			<div id="feed-header">
				<button id="feed-header-button-foryou" class="feed-header-button">
					For you
				</button>
				<button id="feed-header-button-following" class="feed-header-button">
					Following
				</button>
			</div>
		</div>

		<!-- CREATE BUTTON -->

		<?php require ($createButton); ?>

		<!-- PIC -->

		<?php foreach ($pics as $pic): ?>
			<div id="<?php echo $pic->id; ?>" class="pic">
				<div class="pic-recto">
					<div class="pic-header">
						<div class="pic-header-user-datas">
							<img src="<?php echo $pic->user->avatar; ?>">
							<p><?php echo $pic->user->username; ?></p>
						</div>
						<div class="pic-header-icons">
							<button class="button-icon selectable">
								<?php require ("view/assets/icons/trash.svg"); ?>
							</button>
							<button class="button-icon more">
								<?php require ("view/assets/icons/more.svg"); ?>
							</button>
						</div>
					</div>
					<div class="pic-body-recto">
						<img src="<?php echo $pic->image; ?>" />
					</div>
					

					<div class="pic-footer">
						<button class="button-icon selectable">
							<?php require ("view/assets/icons/like.svg") ?>
						</button>
						<button class="button-icon">
							<?php require ("view/assets/icons/comment.svg"); ?>
						</button>
					</div>
				</div>
				<div class="pic-verso">
					<div class="pic-header">
						<div class="pic-header-stats">
							<p><?php echo $pic->likesCount; ?> likes</p>
							<p><?php echo $pic->commentsCount; ?> comments</p>
						</div>
						<div class="pic-header-icons">
							<button class="button-icon selectable">
								<?php require ("view/assets/icons/trash.svg"); ?>
							</button>
							<button class="button-icon more">
								<?php require ("view/assets/icons/more.svg"); ?>
							</button>
						</div>
					</div>
					<div class="pic-body-verso">
						<div class="pic-comments">

							<!-- COMMENT -->
							<?php foreach ($pic->comments as $comment): ?>
								<div class="comment">
									<img src=<?php echo $comment->user->avatar; ?>>
									<div class="comment-text">
										<p class="comment-text-username"><?php echo $comment->user->username; ?></p>
										<p class="comment-text-content"><?php echo $comment->content; ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="pic-footer-verso">
						<div class="pic-input">
							<span class="placeholder">Do you like this pic ? Let us know !</span>
							<textarea class="pic-input-text"></textarea>
							<button class="arrow-up-button button-icon" type="submit">
								<?php require ("view/assets/icons/arrow_up.svg"); ?>
							</button>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>

		<!-- FOLLOWING LIST -->

		<div class="following-list">
			<p class="following-list-title">Following</p>
			<div class="following-list-list">

				<!-- FOLLOW -->

				<button class="follow">
					<img src="temp/pic_example_4.jpg">
					<p>Lorem ipsum</p>
				</button>

			</div>
		</div>

		<!-- SEARCH POPUP -->

		<div id="search-popup">
			<input id="search-popup-input" type="text" placeholder="Search a user...">
			<div class="search-results">

				<!-- SEARCH RESULT -->

				<div class="search-result">
					<img src="temp/pic_example_2.jpg">
					<p>Lorem ipsum</p>
				</div>

			</div>
		</div>


		<!-- ANGLE POPUP -->

		<div id="angle-popup">
			<div id="angle-popup-profile">
				<p id="angle-popup-title">Hi, <span id="angle-popup-title-username">Lorem ipsum !</span></p>
				<div id="angle-popup-content">
					<button class="section">
						<?php require ("view/assets/icons/gallery.svg"); ?>
						<p>Your pics</p>
					</button>
					<button class="section">
						<?php require ("view/assets/icons/moon.svg"); ?>
						<p>Dark mode</p>
					</button>
					<button class="section">
						<?php require ("view/assets/icons/settings.svg"); ?>
						<p>Settings account</p>
					</button>
					<button class="section">
						<?php require ("view/assets/icons/logout.svg"); ?>
						<p>Logout</p>
					</button>
				</div>
			</div>
			<div id="angle-popup-notification">
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
			</div>
		</div>
	</div>
</div>

<!-- MOBILE NAVBAR -->

<div class="mobile-navbar">
	<button class="button-icon selectable">
		<?php require ("view/assets/icons/home.svg"); ?>
	</button>
	<button id="loop-button" class="button-icon selectable">
		<?php require ("view/assets/icons/loop.svg"); ?>
	</button>
	<button class="button-icon selectable">
		<?php require ("view/assets/icons/add.svg"); ?>
	</button>
	<button class="button-icon selectable">
		<?php require ("view/assets/icons/notification.svg"); ?>
	</button>
	<button class="button-icon selectable">
		<?php require ("view/assets/icons/profile.svg"); ?>
	</button>
</div>
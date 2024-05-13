<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Twinkle+Star&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="components.css">
	<link rel="stylesheet" type="text/css" href="colors.css">
	<link rel="stylesheet" type="text/css" href="view/assets/home.css">
	<link rel="stylesheet" type="text/css" href="view/assets/main.css">
	<link rel="stylesheet" type="text/css" href="view/assets/feed.css">
	<link rel="stylesheet" type="text/css" href="view/assets/feed_header.css">
	<link rel="stylesheet" type="text/css" href="view/assets/pic.css">
	<link rel="stylesheet" type="text/css" href="view/assets/comment.css">
	<link rel="stylesheet" type="text/css" href="view/assets/search_popup.css">
	<link rel="stylesheet" type="text/css" href="view/assets/search_result.css">
	<link rel="stylesheet" type="text/css" href="view/assets/angle_popup.css">
	<link rel="stylesheet" type="text/css" href="view/assets/notification.css">
	<link rel="stylesheet" type="text/css" href="view/assets/mobile_navbar.css">
	<link rel="stylesheet" type="text/css" href="view/assets/desktop_navbar.css">
	<link rel="stylesheet" type="text/css" href="view/assets/following_list.css">
	<link rel="stylesheet" type="text/css" href="view/assets/follow.css">
	<link rel="stylesheet" type="text/css" href="view/assets/create_button_1.css">
	<link rel="stylesheet" type="text/css" href="view/assets/create_button_2.css">
	<link rel="stylesheet" type="text/css" href="view/assets/create_button_3.css">
	<link rel="stylesheet" type="text/css" href="view/assets/create_button_4.css">
	<link rel="stylesheet" type="text/css" href="view/assets/create_button_5.css">
	<link rel="stylesheet" type="text/css" href="view/assets/create_button_6.css">

	<title>Crafty Pic</title>
</head>

<body>

	<!-- DESKTOP NAVBAR -->

	<div class="desktop-navbar">
		<button id="desktop-navbar-logo">CraftyPic</button>
		<div id="desktop-navbar-icons">
			<button class="icon">
				<img src="view/assets/loop.svg" />
			</button>
			<button class="icon">
				<img src="view/assets/notification.svg" />
			</button>
			<button class="icon">
				<img src="view/assets/profile.svg" />
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

			<button id="create-button-1"><span id="create-button-1-word-1">Craft</span> <span
					id="create-button-1-word-2">a</span> <span id="create-button-1-word-3">new</span> <span
					id="create-button-1-word-4">pic</span> <span id="create-button-1-word-5">!</span></button>

			<!-- PIC -->

			<div class="pic">
				<div class="pic-recto">
					<div class="pic-header">
						<div class="pic-header-user-datas">
							<img src="view/assets/pic_example_4.jpg">
							<p>Lorem ipsum</p>
						</div>
						<div class="pic-header-icons">
							<button class="icon">
								<img src="view/assets/trash.svg" />
							</button>
							<button class="icon more">
								<img src="view/assets/more.svg" />
							</button>
						</div>
					</div>
					<div class="pic-body-recto"></div>
					<div class="pic-footer">
						<button class="icon like-icon">
							<?php require ("view/assets/like.svg") ?>
						</button>
						<button class="icon">
							<img src="view/assets/comment.svg" />
						</button>
					</div>
				</div>
				<div class="pic-verso">
					<div class="pic-header">
						<div class="pic-header-stats">
							<p>42 likes</p>
							<p>42 comments</p>
						</div>
						<div class="pic-header-icons">
							<button class="icon">
								<img src="view/assets/trash.svg" />
							</button>
							<button class="icon more">
								<img src="view/assets/more.svg" />
							</button>
						</div>
					</div>
					<div class="pic-body-verso">
						<div class="pic-comments">

							<!-- COMMENT -->

							<div class="comment">
								<img src="view/assets/pic_example_4.jpg">
								<div class="comment-text">
									<p class="comment-text-username">Lorem ipsum</p>
									<p class="comment-text-content">Lorem ipsum dolor sit amet, consectetur adipiscing
										elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
										ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.
										ssalsalkdsdjhvjhdfghdfkjvdcnvidbkvdfgivfdg</p>
								</div>
							</div>

						</div>
					</div>
					<div class="pic-footer-verso">
						<div class="pic-input">
							<span class="placeholder">Do you like this pic ? Let us know !</span>
							<textarea class="pic-input-text"></textarea>
							<img src="view/assets/arrow_up.svg" />
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- FOLLOWING LIST -->

		<div class="following-list">
			<p class="following-list-title">Following</p>
			<div class="following-list-list">

				<!-- FOLLOW -->

				<button class="follow">
					<img src="view/assets/pic_example_4.jpg">
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
					<img src="view/assets/pic_example_2.jpg">
					<p>Lorem ipsum</p>
				</div>

			</div>
		</div>


		<!-- ANGLE POPUP -->

		<div id="angle-popup">
			<p id="angle-popup-title">Hi, <span id="angle-popup-title-username">Lorem ipsum !</span></p>
			<div id="angle-popup-content">
				<button class="section">
					<img src="view/assets/gallery.svg">
					<p>Your pics</p>
				</button>
				<button class="section">
					<img src="view/assets/moon.svg">
					<p>Dark mode</p>
				</button>
				<button class="section">
					<img src="view/assets/settings.svg">
					<p>Settings account</p>
				</button>
				<button class="section">
					<img src="view/assets/logout.svg">
					<p>Logout</p>
				</button>
			</div>
		</div>


	</div>

	<!-- MOBILE NAVBAR -->

	<div class="mobile-navbar">
		<button class="icon">
			<img src="view/assets/home.svg" />
		</button>
		<button class="icon">
			<img src="view/assets/loop.svg" />
		</button>
		<button class="icon">
			<img src="view/assets/add.svg" />
		</button>
		<button class="icon">
			<img src="view/assets/notification.svg" />
		</button>
		<button class="icon">
			<img src="view/assets//profile.svg" />
		</button>
	</div>

</body>

<script src="view/scripts/navbar.js" type="module"></script>
<script src="view/scripts/feed.js" type="module"></script>
<script src="view/scripts/pic.js" type="module"></script>
<script src="view/scripts/search_popup.js" type="module"></script>

</html>
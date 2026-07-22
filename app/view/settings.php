<div class="page">
	<div id="settings">
		
		<?php $updated; ?>

		<div class="window">

			<button id="return-home" class="button-icon window-return-button">
				<?php require ("view/assets/icons/return.svg"); ?>
			</button>

			<p class="window-title">Settings account</p>

			<?php
				// Le compte de demonstration est partage : il ne peut pas modifier
				// ses propres donnees (cf. lib/demo.php). Seul le logout reste actif.
				$demoDisabled = isDemoSession() ? ' disabled' : '';
			?>

			<button id="username-button" class="window-section"<?php echo $demoDisabled; ?>>
				<?php require ("view/assets/icons/user.svg"); ?>
				<p>Username</p>
			</button>
			<button id="avatar-button" class="window-section"<?php echo $demoDisabled; ?>>
				<?php require ("view/assets/icons/account.svg"); ?>
				<p>Avatar</p>
			</button>
			<button id="email-button" class="window-section"<?php echo $demoDisabled; ?>>
				<?php require ("view/assets/icons/email.svg"); ?>
				<p>Email</p>
			</button>
			<button id="password-button" class="window-section"<?php echo $demoDisabled; ?>>
				<?php require ("view/assets/icons/password.svg"); ?>
				<p>Password</p>
			</button>
			<button id="notifications-button" class="window-section"<?php echo $demoDisabled; ?>>
				<?php require ("view/assets/icons/notification.svg"); ?>
				<p>Notifications</p>
			</button>
			<button id="logout-button" class="window-section">
				<?php require ("view/assets/icons/logout.svg"); ?>
				<p>Logout</p>
			</button>
		</div>

		<?php if (isDemoSession()): ?>
			<p class="demo-notice">
				Settings are disabled on the shared demo account : the next visitor logs in
				with the same credentials.
			</p>
		<?php endif; ?>

	</div>
</div>
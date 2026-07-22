<?php if (demoEnabled()): ?>

	<!-- DEMO BADGE -->

	<ilandols-demo-badge
		heading="Try CraftyPic instantly"
		description="No sign up, no email to confirm : log in with the account below and have a look around."
		credentials='<?php
			echo htmlspecialchars(json_encode([
				["label" => "Username", "value" => demoUsername()],
				["label" => "Password", "value" => demoPassword()],
			]), ENT_QUOTES, 'UTF-8');
		?>'>
	</ilandols-demo-badge>

<?php endif; ?>

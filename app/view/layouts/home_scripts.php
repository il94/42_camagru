<script src="view/scripts/home.js" type="module"></script>

<script src="view/scripts/logo.js" type="module"></script>
<script src="view/scripts/feed.js" type="module"></script>
<script src="view/scripts/pic.js" type="module"></script>
<script src="view/scripts/navbar_popups.js" type="module"></script>
<script src="view/scripts/icon.js" type="module"></script>

<?php if (demoEnabled()): ?>
	<script src="view/scripts/vendor/ilandols-demo-badge.js" type="module"></script>
<?php endif; ?>
<?php if (isDemoSession()): ?>
	<script src="view/scripts/demo_dialog.js" type="module"></script>
<?php endif; ?>
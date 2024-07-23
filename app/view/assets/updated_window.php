<?php

if ($email)
	$data = 'Email';
else
	$data = ucfirst($_GET['data']);

?>

<div id="success-popup" class="window success">
	<p class="window-message">
		<?php echo $data; ?> successfully updated !
	</p>
</div>
<?php

require_once('controller/home.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$client = connectDB();

	if ($_GET['route'] === "comment") {
		createComment($client, 1, $_GET['picId'], htmlspecialchars($_POST['newComment']));
	
		http_response_code(201);
	}
}
else {
	// echo ($_SERVER['REQUEST_METHOD']);
	// echo "Home";
	home();
}
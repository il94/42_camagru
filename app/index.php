<?php

require_once('init.php');

require_once('controller/AuthController.php');
require_once('controller/HomeController.php');

$authController = new AuthController();
$homeController = new HomeController();

if (isset($_GET['action']) && $_GET['action']) {
	// HOME
	if ($_GET['action'] === 'home') {

		// POST
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($_GET['route'] == 'comment') {
				if (isset($_GET['picId']) && $_GET['picId']) {
					$homeController->postComment(1, $_GET['picId'], $_POST['comment']);
					http_response_code(201);
				}
			}
		}
	}
}
else {
	// initApp(); // A appeller lors du premier lancement du programme

	// $homeController->get(null, null);
	$authController->get(null, null);
}
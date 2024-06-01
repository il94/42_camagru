<?php

require_once('init.php');
require_once('config.php');

require_once('controller/AuthController.php');
require_once('controller/HomeController.php');

$authController = new AuthController();
$homeController = new HomeController();

if (paramExist($_GET['page'])) {

	// HOME
	if ($_GET['page'] === 'home') {

		// POST
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// COMMENT
			if ($_GET['route'] === 'comment') {
				if (isset($_GET['picId']) && $_GET['picId']) {
					$homeController->postComment(1, $_GET['picId'], $_POST['comment']);
					http_response_code(201);
				}
			}
		}

		// GET
		else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$homeController->get(null, null);
		}
	}

	// AUTH
	else if ($_GET['page'] === 'auth') {

		// POST
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			// LOGIN
			if ($_GET['route'] === 'login') {
				$authController->login($_POST['login'], $_POST['password']);
			}

			// SIGNUP
			else if ($_GET['route'] === 'signup') {
				$authController->signup($_POST['email'], $_POST['username'], $_POST['password'], $_POST['retypepassword']);
			}
		}

		// GET
		else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

			// SIGNUP
			if ($_GET['route'] === 'signup') {
				$authController->getSignup(null, null);
				http_response_code(200);
			}

			// LOGIN
			else if ($_GET['route'] === 'login') {
				$authController->getLogin(null, null);
				http_response_code(200);
			}
		}
	}

	else {
		$body = require_once('view/not_found.php');

		require_once('view/layout.php');
	}

}

else {
	// initApp(); // A appeller lors du premier lancement du programme

	$authController->getLogin(null, null);
}
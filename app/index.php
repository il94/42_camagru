<?php

require_once('config.php');

require_once('controller/AuthController.php');
require_once('controller/HomeController.php');
require_once('controller/CreateController.php');
require_once('controller/SettingsController.php');

$authController = new AuthController();
$homeController = new HomeController();
$createController = new CreateController();
$settingsController = new SettingsController();

session_start();

function notFound() {
	$body = require_once('view/not_found.php');
	require_once('view/layout.php');
}

// Inputs client
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
$route = filter_input(INPUT_GET, 'route', FILTER_SANITIZE_SPECIAL_CHARS);
$state = filter_input(INPUT_GET, 'state', FILTER_SANITIZE_SPECIAL_CHARS);

$picIdGet = filter_input(INPUT_GET, 'picId', FILTER_VALIDATE_INT);
$picIdPost = filter_input(INPUT_POST, 'picId', FILTER_VALIDATE_INT);
$picId = $picIdGet ?? $picIdPost;
$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);
$cursor = filter_input(INPUT_GET, 'cursor', FILTER_VALIDATE_INT);

$emailGet = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$emailPost = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$email = $emailGet ?? $emailPost;
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
$retypepassword = filter_input(INPUT_POST, 'retypepassword', FILTER_SANITIZE_SPECIAL_CHARS);
$tokenGet = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
$tokenPost = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS);
$token = $tokenGet ?? $tokenPost;

// Session
$userId = $_SESSION['logged_in'];

// Method
$method = $_SERVER['REQUEST_METHOD'];

if ($page) {

	if ($page === 'home_guest') {
		$homeController->getGuest(null, null);
	}

	// HOME
	else if ($page === 'home') {

		// POST
		if ($method === 'POST') {

			if (!$userId) {
				$body = require_once('view/pas_co.php');
	
				require_once('view/layout.php');
			}
			else {

				// COMMENT
				if ($route === 'comment') {
					$homeController->postComment($userId, $picId, $comment);
				}

				// LIKE
				else if ($route === 'like') {
					$homeController->likePic($userId, $picId);
				}

				else
					notFound();	
			}

		}

		// GET
		else if ($method === 'GET') {

			if ($route) {

				// PICS
				if ($route === 'pics') {
					$homeController->getPics($userId, $cursor);
					http_response_code(200);
				}

				// COMMENTS
				else if ($route === 'comments') {
					$homeController->getComments($picId, $cursor);
					http_response_code(200);
				}

				else
					notFound();
			}

			// DEFAULT
			else {

				if (!$userId) {
					$body = require_once('view/pas_co.php');
		
					require_once('view/layout.php');
				}
				else {	
					$homeController->get(null, null);
				}
			}
		}

		// DELETE
		else if ($method === 'DELETE') {
			$homeController->deletePic($userId, $picId);
			http_response_code(200);
		}

		else
			notFound();
	}

	// CREATE
	else if ($page === 'create') {

		if (!$userId) {
			$body = require_once('view/pas_co.php');

			require_once('view/layout.php');
		}
		else {

			// POST
			if ($method === 'POST') {
				$createController->createPics($userId, $_FILES, $_POST);
			}

			// GET
			else if ($method === 'GET') {
				$createController->get(null, null);
			}

			else
				notFound();
		}
	}

	// AUTH
	else if ($page === 'auth') {

		// POST
		if ($method === 'POST') {

			// LOGIN
			if ($route === 'login') {

				if ($state) {

					// FORGOT PASSWORD
					if ($state === 'forgot-password') {
						$authController->forgotPassword($login);
					}

					// REINITIALIZATION
					else if ($state === 'reinitialization') {
						$authController->reinitialization($password, $retypepassword, $token);
					}

					else
						notFound();

				}
				else {
					$authController->login($login, $password);
				}
			}

			// SIGNUP
			else if ($route === 'signup') {
				$authController->signup($email, $username, $password, $retypepassword);
			}

			else if ($route === 'update') {
				$authController->update($userId, $_POST, $_FILES);
			}

			// LOGOUT
			else if ($route === 'logout') {
				$authController->logout();
			}

			else
				notFound();
		}

		// GET
		else if ($method === 'GET') {

			// SIGNUP
			if ($route === 'signup') {

				// ACTIVATE
				if ($state) {
					$authController->getSignup($state, null);
					http_response_code(200);
				}

				// ACTIVATION
				else if ($token) {
					$authController->activateAccount($token);
					http_response_code(200);
				}

				// DEFAULT
				else {
					$authController->getSignup(null, null);
					http_response_code(200);
				}
			}

			// LOGIN
			else if ($route === 'login') {

				// FORGOT PASSWORD
				if ($state) {
					$authController->getLogin($state);
					http_response_code(200);
				}

				// DEFAULT
				else {
					$authController->getLogin(null);
					http_response_code(200);
				}
			}

			else
				notFound();
		}

		else
			notFound();
	}

	// SETTINGS
	else if ($page === 'settings') {

		if (!$userId) {
			$body = require_once('view/pas_co.php');

			require_once('view/layout.php');
		}
		else {

			// POST
			if ($method === 'POST') {

				// FORGOT PASSWORD
				if ($route === 'forgot-password') {
					$settingsController->forgotPassword($userId);
				}

				else
					notFound();
			}

			// GET
			else if ($method === 'GET') {

				// STATE
				if ($state) {
					$settingsController->get($state, null);
					http_response_code(200);
				}

				// UPDATE
				else if ($token) {
					$settingsController->updateEmail($email, $token);
					http_response_code(200);
				}

				// UPDATED
				else if ($route === 'updated') {
					$settingsController->get(null, null);
				}

				// DEFAULT
				else {
					$settingsController->get(null, null);
				}
			}

			else
				notFound();
		}
	}

	else
		notFound();

}

else {
	$authController->getLogin('redirect');
}
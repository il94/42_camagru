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

if (empty($_SESSION['csrf_token'])) {
	$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SERVER['HTTP_X_CSRF_TOKEN'];

// Inputs client
$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
$route = filter_input(INPUT_GET, 'route', FILTER_SANITIZE_SPECIAL_CHARS);
$state = filter_input(INPUT_GET, 'state', FILTER_SANITIZE_SPECIAL_CHARS);

$picIdGet = filter_input(INPUT_GET, 'picId', FILTER_VALIDATE_INT);
$picIdPost = filter_input(INPUT_POST, 'picId', FILTER_VALIDATE_INT);
$picId = $picIdGet ?? $picIdPost;
$commentSize = strlen($comment);
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

if ($method === 'POST' && $route !== 'login' && $route !== 'signup' && !hash_equals($_SESSION['csrf_token'], $csrfToken))
	forbidden();

if ($page) {

	if ($page === 'home_guest') {
		$homeController->getGuest();
	}

	// HOME
	else if ($page === 'home') {

		// POST
		if ($method === 'POST') {

			if (!$userId)
				pasCo();
			else {

				// COMMENT
				if ($route === 'comment') {
					$homeController->postComment($userId, $picId, $comment, $commentSize);
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
				}

				// COMMENTS
				else if ($route === 'comments') {
					$homeController->getComments($picId, $cursor);
				}

				else
					notFound();
			}

			// DEFAULT
			else {

				if (!$userId)
					pasCo();
				else {	
					$homeController->get();
				}
			}
		}

		// DELETE
		else if ($method === 'DELETE') {
			$homeController->deletePic($userId, $picId);
		}

		else
			notFound();
	}

	// CREATE
	else if ($page === 'create') {

		if (!$userId)
			pasCo();
		else {

			// POST
			if ($method === 'POST') {
				$createController->createPics($userId, $_FILES, sanitizeStickersData($_POST));
			}

			// GET
			else if ($method === 'GET') {
				$createController->get();
			}

			else
				notFound();
		}
	}

	// AUTH
	else if ($page === 'auth') {

		// POST
		if ($method === 'POST') {

			// LOGOUT
			if ($route === 'logout') {
				if (!$userId)
					Co();
				else
					$authController->logout();
			}

			else if ($route === 'update') {
				if (!$userId)
					Co();
				else
					$authController->update($userId, sanitizeUpdateDatas($_POST), $_FILES);
			}

			else {

				if ($userId)
					Co();
				else {

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

					else
						notFound();
				}
			}
		}

		// GET
		else if ($method === 'GET') {

			if ($userId)
				Co();
			else {

				// SIGNUP
				if ($route === 'signup') {

					// ACTIVATE
					if ($state) {
						$authController->getSignup($state);
					}

					// ACTIVATION
					else if ($token) {
						$authController->activateAccount($token);
					}

					// DEFAULT
					else {
						$authController->getSignup(null);
					}
				}

				// LOGIN
				else if ($route === 'login') {

					// FORGOT PASSWORD
					if ($state) {
						$authController->getLogin($state);
					}

					// DEFAULT
					else {
						$authController->getLogin(null);
					}
				}

				else
					notFound();
			}
		}

		else
			notFound();
	}

	// SETTINGS
	else if ($page === 'settings') {

		// POST
		if ($method === 'POST') {

			if (!$userId)
				pasCo();
			else {

				// FORGOT PASSWORD
				if ($route === 'forgot-password') {
					$settingsController->forgotPassword($userId);
				}

				else
					notFound();
			}
		}

		// GET
		else if ($method === 'GET') {

			// UPDATE
			if ($token) {

				if ($userId)
					Co();
				else
					$settingsController->updateEmail($email, $token);
			}
			else {

				if (!$userId)
					pasCo();
				else {

					// STATE
					if ($state) {
						$settingsController->get($state);
					}

					// UPDATED
					else if ($route === 'updated') {
						$settingsController->get(null);
					}

					// DEFAULT
					else {
						$settingsController->get(null);
					}
				}
			}
		}

		else
			notFound();
	}

	else
		notFound();

}

else {
	$authController->getLogin('redirect');
}
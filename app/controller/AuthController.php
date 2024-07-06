<?php

require_once('model/auth.php');

class AuthController
{
	public AuthService $service;

	public function __construct() {
		$this->service = new AuthService();
	}

	public function login($login, $password) {
		try {
			$this->service->login($login, $password);
			http_response_code(201);
		}
		catch (HttpException $error) {
			http_response_code($error->getCode());

			$response = new stdClass();
			$response->message = $error->getMessage();
			$response->field = $error->getField();

			echo json_encode($response);
		}
	}

	public function signup($email, $username, $password, $reTypePassword) {
		try {
			$this->service->signup($email, $username, $password, $reTypePassword);
			http_response_code(201);
		}
		catch (HttpException $error) {
			http_response_code($error->getCode());

			$response = new stdClass();
			$response->message = $error->getMessage();
			$response->field = $error->getField();

			echo json_encode($response);
		}
	}

	public function activateAccount($token) {
		try {
			$this->service->activateAccount($token);
			$this->getSignup("activate", null);
			http_response_code(200);
		}
		catch (HttpException $error) {
			http_response_code($error->getCode());

			$response = new stdClass();
			$response->message = $error->getMessage();
			$response->field = $error->getField();

			echo json_encode($response);
		}
	}

	public function logout() {
		try {
			$this->service->logout();
			http_response_code(201);
		}
		catch (HttpException $error) {
			http_response_code($error->getCode());

			$response = new stdClass();
			$response->message = $error->getMessage();
			$response->field = $error->getField();

			echo json_encode($response);
		}
	}

	public function getLogin($route, $id) {

		if ($route && $id) {
			echo "temp";
		}
		else {
			$header = require_once('view/layouts/auth_assets.php');
			$body = require_once('view/auth_login.php');
			$scripts = require_once("view/layouts/auth_scripts.php");

			require_once('view/layout.php');
		}
	}

	public function getSignup($state, $id) {

		$header = require_once('view/layouts/auth_assets.php');

		if ($state) {
			if ($state === "activation")
				$body = require_once('view/auth_activation.php');
			else if ($state === "activate")
				$body = require_once('view/auth_activate.php');
		}
		else {
			$body = require_once('view/auth_signup.php');
		}

		$scripts = require_once("view/layouts/auth_scripts.php");

		require_once('view/layout.php');
	}
}
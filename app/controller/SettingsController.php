<?php

require_once('model/settings.php');

class SettingsController {

	public SettingsService $service;

	public function __construct() {
		$this->service = new SettingsService();
	}

	public function forgotPassword($userId) {
		try {
			$response = $this->service->forgotPassword($userId);

			http_response_code(201);
			header("Location: /settings/reinitialization-start");
			echo json_encode($response);
			exit();
		}
		catch (HttpException $error) {
			http_response_code($error->getCode());

			$response = new stdClass();
			$response->message = $error->getMessage();
			$response->field = $error->getField();

			echo json_encode($response);
		}
	}

	public function get($state, $id) {

		$headers = require_once("view/layouts/settings_assets.php");
		$user = $this->service->authService->getUserAuth($_SESSION['logged_in']);
		$updated = null;

		if ($state) {
			if ($state === "updated") {
				$updated = require_once('view/assets/updated_window.php');
				$body = require_once('view/settings.php');
			}
			else if ($state === "updatedEmail") {
				$email = true;
				$updated = require_once('view/assets/updated_window.php');
				$body = require_once('view/settings.php');
			}
			else if ($state === "update_start")
				$body = require_once('view/settings_update_start.php');
			else if ($state === "username")
				$body = require_once('view/settings_username.php');
			else if ($state === "avatar")
				$body = require_once('view/settings_avatar.php');
			else if ($state === "email")
				$body = require_once('view/settings_email.php');
			else if ($state === "password")
				$body = require_once('view/settings_password.php');
			else if ($state === "reinitialization-start")
				$body = require_once('view/settings_reinitialization_start.php');
			else if ($state === "notifications")
				$body = require_once('view/settings_notifications.php');
		}
		else {
			$body = require_once('view/settings.php');
		}

		$scripts = require_once("view/layouts/settings_scripts.php");

		require_once('view/layout.php');

		http_response_code(200);
	}

	public function updateEmail($email, $token) {
		try {
			$this->service->authService->updateEmail($email, $token);
			$this->get("updatedEmail", null);
			
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

}
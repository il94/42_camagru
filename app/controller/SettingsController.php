<?php

require_once('model/settings.php');

class SettingsController {

	public SettingsService $service;

	public function __construct() {
		$this->service = new SettingsService();
	}

	public function get($state, $id) {

		$headers = require_once("view/layouts/settings_assets.php");

		if ($state) {
			if ($state === "username")
				$body = require_once('view/settings_username.php');
			else if ($state === "avatar")
				$body = require_once('view/settings_avatar.php');
			else if ($state === "email")
				$body = require_once('view/settings_email.php');
			else if ($state === "password")
				$body = require_once('view/settings_password.php');
			else if ($state === "notifications")
				$body = require_once('view/settings_notifications.php');
		}
		else {
			$body = require_once('view/settings.php');
		}

		$scripts = require_once("view/layouts/settings_scripts.php");

		require_once('view/layout.php');
	}
}
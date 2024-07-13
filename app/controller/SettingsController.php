<?php

require_once('model/settings.php');

class SettingsController {

	public SettingsService $service;

	public function __construct() {
		$this->service = new SettingsService();
	}

	public function get($route, $id) {

		if ($route && $id) {
			echo "temp";
		}
		else {
			$headers = require_once("view/layouts/settings_assets.php");
			$body = require_once('view/settings.php');
			$scripts = require_once("view/layouts/settings_scripts.php");

			require_once('view/layout.php');
		}
	}
}
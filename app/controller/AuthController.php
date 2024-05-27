<?php

class AuthController
{
	public function get($route, $id) {

		if ($route && $id) {
			echo "temp";
		}
		else {

			$header = require_once('view/layouts/auth_assets.php');
			$body = require_once('view/auth.php');
			$scripts = require_once("view/layouts/auth_scripts.php");

			require_once('view/layout.php');
		}
	}
}
<?php

class AuthController
{
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

	public function getSignup($route, $id) {

		if ($route && $id) {
			echo "temp";
		}
		else {
			$header = require_once('view/layouts/auth_assets.php');
			$body = require_once('view/auth_signup.php');
			$scripts = require_once("view/layouts/auth_scripts.php");

			require_once('view/layout.php');
		}
	}
}
<?php

class AuthController
{
	public function get($route, $id) {

		if ($route && $id) {
			echo "temp";
		}
		else {

			$body = require_once('view/auth.php');

			require_once('view/layout.php');
		}
	}
}
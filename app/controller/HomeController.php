<?php

require_once('model/home.php');

class HomeController {

	public HomeService $service;

	public function __construct() {
		$this->service = new HomeService();
	}

	public function get($route, $id) {

		if ($route && $id) {
			echo "temp";
		}
		else {
			$createButton = getRandomCreateButton();
			
			$pics = $this->service->getLastFivePics();

			$headers = require_once("view/layouts/home_assets.php");
			$body = require_once('view/home.php');
			$scripts = require_once("view/layouts/home_scripts.php");

			require_once('view/layout.php');
		}
	}

	public function postComment($userId, $picId, $content) {
		$this->service->createComment($userId, $picId, $content);
	}
}
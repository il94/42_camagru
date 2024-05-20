<?php

require_once('model/home.php');

class HomeController {

	public HomeService $service;

	function __construct() {
		$this->service = new HomeService();
	}

	public function get($route, $id) {

		if ($route && $id) {
			echo "temp";
		}
		else {
			$createButton = getRandomCreateButton();
			
			$pics = $this->service->getLastFivePics();

			require_once('view/home.php');

		}
	}

	public function postComment($userId, $picId, $content) {
		$this->service->createComment($userId, $picId, $content);
	}
}
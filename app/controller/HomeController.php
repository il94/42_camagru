<?php

require_once('model/home.php');

class HomeController {

	public HomeService $service;

	public function __construct() {
		$this->service = new HomeService();
	}

	public function postComment($userId, $picId, $content) {
		try {
			$this->service->createComment($userId, $picId, $content);
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

	public function likePic($userId, $picId) {
		try {
			$code = $this->service->likePic($userId, $picId);
			http_response_code($code);
		}
		catch (HttpException $error) {
			http_response_code($error->getCode());

			$response = new stdClass();
			$response->message = $error->getMessage();
			$response->field = $error->getField();

			echo json_encode($response);
		}
	}

	public function getPics($userId, $cursor) {
		try {
			$response = $this->service->getPics($userId, $cursor);

			http_response_code(200);
			echo json_encode($response);
		}
		catch (HttpException $error) {
			http_response_code($error->getCode());

			$response = new stdClass();
			$response->message = $error->getMessage();
			$response->field = $error->getField();

			echo json_encode($response);
		}
	}

	public function getComments($picId, $cursor) {
		try {
			$response = $this->service->getComments($picId, $cursor);

			http_response_code(200);
			echo json_encode($response);
		}
		catch (HttpException $error) {
			http_response_code($error->getCode());

			$response = new stdClass();
			$response->message = $error->getMessage();
			$response->field = $error->getField();

			echo json_encode($response);
		}
	}

	public function get($route, $id) {

		$user = $this->service->authService->getUserAuth($_SESSION['logged_in']);

		if ($route && $id) {
			echo "temp";
		}
		else {
			$createButton = getRandomCreateButton();

			$headers = require_once("view/layouts/home_assets.php");
			$body = require_once('view/home.php');
			$scripts = require_once("view/layouts/home_scripts.php");

			require_once('view/layout.php');
		}
	}
}
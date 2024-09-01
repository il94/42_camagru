<?php

// Etabli une connection a la DB
function connectDB() {
	try {
		$client = new PDO(
			$_ENV['MYSQL_DSN'],
			$_ENV['MYSQL_ROOT'],
			$_ENV['MYSQL_ROOT_PASSWORD'], [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_STRINGIFY_FETCHES => false,
			]
		);

		return ($client);
	}
	catch (Exception $error) {
		die($error->getMessage());
	}
}

// Print le contenu d'un objet de maniere plus claire
function prettyPrint($object) {
	echo "<pre>";
		print_r($object);
	echo "</pre>";
}

function paramExist($param) {
	return !empty($param) || $param === '0' || $param === 0;
}

function createImage($base64Image) {
	list($type, $base64Image) = explode(';', $base64Image);
	list(, $base64Image)      = explode(',', $base64Image);

	$base64Image = base64_decode($base64Image);

	$imageName = uniqid() . '.png';
	$picPath = UPLOAD_RELATIVE_PATH . $imageName;

	if (file_put_contents(UPLOAD_ABSOLUTE_PATH . $imageName, $base64Image))
		return ($picPath);
	return (false);
}

function endsWith($haystack, $needle) {
	$length = strlen($needle);
	if ($length == 0) {
		return true;
	}
	return (substr($haystack, -$length) === $needle);
}

function sanitizeStickersData($data) {
	$sanitizedData = [];

	foreach ($data as $key => $jsonString) {
		$decodedData = json_decode($jsonString, false);

		if (json_last_error() === JSON_ERROR_NONE) {
			$sanitizedEntry = [];
			foreach ($decodedData as $item) {
				if (!(property_exists($item, 'src') &&
					property_exists($item, 'left') &&
					property_exists($item, 'top'))) {
					badRequest();
				}

				$sanitizedItem = [
					'src' => filter_var($item->src, FILTER_SANITIZE_SPECIAL_CHARS),
					'left' => filter_var($item->left, FILTER_SANITIZE_SPECIAL_CHARS),
					'top' => filter_var($item->top, FILTER_SANITIZE_SPECIAL_CHARS),
				];

				$sanitizedEntry[] = $sanitizedItem;
			}

			$sanitizedData[$key] = json_encode($sanitizedEntry);
		}
		else {
			badRequest();
		}
	}

	return $sanitizedData;
}

function sanitizeFile($file) {
	if ($file['error'] !== UPLOAD_ERR_OK)
		throw new HttpException("File upload error", 400, "");

	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$mimeType = finfo_file($finfo, $file['tmp_name']);
	finfo_close($finfo);

	if (!in_array($mimeType, ALLOWED_MIMETYPES))
		throw new HttpException("File upload error", 400, "");

	$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

	if (!in_array($fileExtension, ALLOWED_EXTENSIONS))
		throw new HttpException("File upload error", 400, "");

	if ($file['size'] > MAX_FILE_SIZE)
		throw new HttpException("File upload error", 400, "");
}

function sanitizeUpdateDatas($datas) {
	$sanitizedData = [];

	$stringFields = ['email', 'username', 'currentpassword', 'newpassword', 'retypenewpassword'];
	foreach ($stringFields as $field) {
		if (isset($datas[$field]))
			$sanitizedData[$field] = filter_var(trim($datas[$field]), FILTER_SANITIZE_SPECIAL_CHARS);
	}

	$booleanFields = ['notification_like', 'notification_comment'];
	foreach ($booleanFields as $field) {
		if (isset($datas[$field]))
			$sanitizedData[$field] = filter_var($datas[$field], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
	}

	return $sanitizedData;
}

function badRequest() {
	http_response_code(400);
	exit();
}

function forbidden() {
	http_response_code(403);
	exit();
}

function notFound() {
	$body = require_once('view/not_found.php');
	require_once('view/layout.php');
	
	http_response_code(404);
}

function pasCo() {
	header("Location: /login");
	exit();
}

function Co() {
	header("Location: /");
	exit();
}

function error($message, $code) {

	$header = require_once('view/layouts/auth_assets.php');
	$body = require_once('view/auth_error.php');
	$scripts = require_once("view/layouts/auth_scripts.php");
	require_once('view/layout.php');

	http_response_code($code);
}

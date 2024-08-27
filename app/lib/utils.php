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

function saveImage($imageType, $file) {
	
	$imageName = urlencode(basename($_FILES[$imageType]['name']));
	$imagePath = UPLOAD_RELATIVE_PATH . $imageName;

	if (move_uploaded_file($_FILES[$imageType]['tmp_name'], UPLOAD_ABSOLUTE_PATH . $imageName))
		return ($imagePath);
	return (false);
}

function endsWith($haystack, $needle) {
	$length = strlen($needle);
	if ($length == 0) {
		return true;
	}
	return (substr($haystack, -$length) === $needle);
}
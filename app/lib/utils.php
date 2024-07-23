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
	return (isset($param) && $param);
}

function saveImage() {
	$imageName = urlencode(basename($_FILES['avatar']['name']));
	$imagePath = UPLOAD_RELATIVE_PATH . $imageName;

	if (move_uploaded_file($_FILES['avatar']['tmp_name'], UPLOAD_ABSOLUTE_PATH . $imageName))
		return ($imagePath);
	return (false);
}
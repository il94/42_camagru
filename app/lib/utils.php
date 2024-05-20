<?php

// Etabli une connection a la DB
function connectDB() {
	try {
		$client = new PDO(
			$_ENV['MYSQL_DSN'],
			$_ENV['MYSQL_ROOT'],
			$_ENV['MYSQL_ROOT_PASSWORD']
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
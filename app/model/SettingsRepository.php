<?php

class SettingsRepository {
	public ?PDO $database = null;

	public function __construct() {
		$this->database = connectDB();
	}

	/* ==================== ROUTES ==================== */

}
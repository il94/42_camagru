<?php

class SettingsService {
	public SettingsRepository $repository;
	public AuthService $authService;

	public function __construct() {
		$this->repository = new SettingsRepository();
		$this->authService = new AuthService();
	}

	/* ==================== ROUTES ==================== */


}
<?php

class SettingsService {
	public SettingsRepository $repository;
	public AuthService $authService;

	public function __construct() {
		$this->repository = new SettingsRepository();
		$this->authService = new AuthService();
	}

	/* ==================== ROUTES ==================== */

	// Envoie un mail de recuperation de mot de passe
	public function forgotPassword($userId): string {
		$userDatas = $this->authService->repository->findUserById($userId);

		if (empty($userDatas))
			throw new HttpException("User not found", 403, $this->authService::LOGIN_ERROR);

		$this->authService->sendResetPasswordEmail($userDatas);

		return ($userDatas->email);
	}

}
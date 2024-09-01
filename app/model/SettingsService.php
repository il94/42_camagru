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
		$userFound = $this->authService->repository->findUserById($userId);

		if (empty($userFound))
			throw new HttpException("User not found", 403, $this->authService::LOGIN_ERROR);

		$userDatas = new stdClass();
		$userDatas->id = $userFound->id;
		$userDatas->email = $userFound->email;
		$userDatas->reset_password_token = $this->authService->getRandomToken();
		$userDatas->reset_password_token_expires_at = $this->authService->getExpiresDate(null);
	
		$this->authService->repository->updateUserResetPasswordToken($userDatas);
		$this->authService->repository->updateUserResetPasswordTokenExpiresAt($userDatas);
		$this->authService->sendResetPasswordEmail($userDatas);

		return ($userFound->email);
	}

}
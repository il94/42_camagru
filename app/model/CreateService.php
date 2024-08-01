<?php

class CreateService {
	public CreateRepository $repository;
	public AuthService $authService;

	public function __construct() {
		$this->repository = new CreateRepository();
		$this->authService = new AuthService();
	}

	/* ==================== ROUTES ==================== */

	// Crée une pic
	public function createPic($userId, $picUrl) {
		$user = $this->authService->repository->findUserById($userId);
		if (!$user)
			throw new HttpException("User not found", 404, '');

		$picPath = createImage($picUrl);
		if (!$picPath)
			throw new HttpException("Invalid pic", 403, $this->authService::AVATAR_ERROR);

		$picDatas = new stdClass();

		$picDatas->userId = $userId;
		$picDatas->image = $picPath;

		$this->repository->createPic($picDatas);
	}

}
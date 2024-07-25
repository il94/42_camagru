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
	public function createPic($userId, $files) {

		$user = $this->authService->repository->findUserById($userId);
		if (!$user)
			throw new HttpException("User not found", 404, '');

		$picDatas = new stdClass();
		$picDatas->userId = $userId;

		$picPath = saveImage('pic');
		if (!$picPath)
			throw new HttpException("Invalid pic", 403, '' /* self::PIC_ERROR */);

		$picDatas->image = $picPath;
		$this->repository->createPic($picDatas);
	}

}
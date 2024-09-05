<?php

class CreateService {
	public CreateRepository $repository;
	public AuthService $authService;

	// CONSTANTES
	const STICKERS_HEIGHT = 75;
	const STICKERS_MIN_LEFT = -50;
	const STICKERS_MAX_LEFT = 350;
	const STICKERS_MIN_TOP = -37.5;
	const STICKERS_MAX_TOP = 362.5;

	public function __construct() {
		$this->repository = new CreateRepository();
		$this->authService = new AuthService();
	}

	/* ==================== ROUTES ==================== */

	// Crée des pics
	public function createPics($userId, $dataPics) {

		if (count($dataPics->image) < 1 || count($dataPics->image) > 5)
			throw new HttpException("Bad request", 400, '');

		$user = $this->authService->repository->findUserById($userId);
		if (!$user)
			throw new HttpException("User not found", 404, '');

		$uploadedFiles = [];
		foreach ($dataPics->image as $imagesKey => $imageData) {
			$stickersKey = 'stickersData_' . str_replace('canvas_', '', $imagesKey);
			if (!isset($dataPics->stickersData[$stickersKey]))
				badRequest();

			sanitizeFile($imageData);
			$stickers = json_decode($dataPics->stickersData[$stickersKey], false);

			try {
				$uploadedFiles[] = $this->processImageWithStickers($imageData['tmp_name'], $stickers);
			}
			catch (HttpException $error) {
				foreach ($uploadedFiles as $uploadedFile) {
					$uploadedFilePath = getcwd() . $uploadedFile;
					if (file_exists($uploadedFilePath))
						unlink($uploadedFilePath);
				}
				throw $error;
			}
		}

		$picsDatas = [];
		for ($i = 0; $i < count($uploadedFiles); $i++) {
			 $picData = new stdClass();
		
			 $picData->userId = $userId;
			 $picData->image = $uploadedFiles[$i];
		
			 $picsDatas[] = $picData;
		}

		$this->repository->createPics($picsDatas);
	}

	private function processImageWithStickers($tmpName, $stickers) {
		$image = imagecreatefrompng($tmpName);
		if (!$image)
			throw new HttpException("Failed to load image", 400, "");

		try {
			foreach ($stickers as $sticker) {
				$this->applySticker($image, $sticker);
			}
		
			$picName = uniqid() . '.png';
			$filePath = UPLOAD_ABSOLUTE_PATH . $picName;
			imagepng($image, $filePath);

			$picPath = UPLOAD_RELATIVE_PATH . $picName;	
		
			return $picPath;
		}
		finally {
			imagedestroy($image);
		}

	}

	private function applySticker($image, $sticker) {
		try {
			$stickerPath = STICKERS_PATH . basename($sticker->src);
			$stickerImage = @imagecreatefrompng($stickerPath);

			if (!$stickerImage)
				throw new HttpException("Failed to load sticker", 400, "");

			$stickerSize = getimagesize($stickerPath);

			$width = $stickerSize[0] * (self::STICKERS_HEIGHT / $stickerSize[1]);
			$height = self::STICKERS_HEIGHT;
			$left = max(self::STICKERS_MIN_LEFT, min(floatval($sticker->left), self::STICKERS_MAX_LEFT));
			$top = max(self::STICKERS_MIN_TOP, min(floatval($sticker->top), self::STICKERS_MAX_TOP));
		
			$error = !imagecopyresampled(
				$image, $stickerImage,
				$left, $top,
				0, 0,
				$width, $height,
				imagesx($stickerImage), imagesy($stickerImage)
			);
			if ($error)
				throw new HttpException("Failed to create pic", 400, "");
		}
		finally {			
			if ($stickerImage)
				imagedestroy($stickerImage);
		}
	}
}
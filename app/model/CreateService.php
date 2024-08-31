<?php

class CreateService {
	public CreateRepository $repository;
	public AuthService $authService;

	// CONSTANTES
	const ALLOWED_MIMETYPES = [
		"image/png",
	];
	const ALLOWED_EXTENSIONS = [
		"png",
	];
	const MAX_FILE_SIZE = 2.5 * 1024 * 1024;

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
		$user = $this->authService->repository->findUserById($userId);
		if (!$user)
			throw new HttpException("User not found", 404, '');

		$uploadedFiles = [];
		foreach ($dataPics->image as $imagesKey => $imageData) {
			$stickersKey = 'stickersData_' . str_replace('canvas_', '', $imagesKey);
			if (!isset($dataPics->stickersData[$stickersKey]))
				badRequest();

			$this->sanitizeFile($imageData);

			// prettyPrint($imageData);
			$stickers = json_decode($dataPics->stickersData[$stickersKey], false);
			$uploadedFiles[] = $this->processImageWithStickers($imageData['tmp_name'], $stickers);
		}

		exit();

		$picsDatas = [];
		for ($i = 0; $i < count($uploadedFiles); $i++) {
			 $picData = new stdClass();
		
			 $picData->userId = $userId;
			 $picData->image = $uploadedFiles[$i];
		
			 $picsDatas[] = $picData;
		}

		$this->repository->createPics($picsDatas);
	}

	private function sanitizeFile($file) {
		if ($file['error'] !== UPLOAD_ERR_OK)
			throw new HttpException("File upload error", 400, "");

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mimeType = finfo_file($finfo, $file['tmp_name']);
		finfo_close($finfo);

		if (!in_array($mimeType, self::ALLOWED_MIMETYPES))
			throw new HttpException("File upload error", 400, "");

		$fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

		if (!in_array($fileExtension, self::ALLOWED_EXTENSIONS))
			throw new HttpException("File upload error", 400, "");

		if ($file['size'] > self::MAX_FILE_SIZE)
			throw new HttpException("File upload error", 400, "");
	}

	private function processImageWithStickers($tmpName, $stickers) {
		$image = imagecreatefrompng($tmpName);
		if (!$image)
			throw new HttpException("Failed to load image", 400, "");

		// prettyPrint($stickers);

		// prettyPrint($stickers[0]->src);


		foreach ($stickers as $sticker) {
			$this->applySticker($image, $sticker);
		}
	
		$picName = uniqid() . '.png';
		$filePath = UPLOAD_ABSOLUTE_PATH . $picName;
		imagepng($image, $filePath);

		$picPath = UPLOAD_RELATIVE_PATH . $picName;	
		imagedestroy($image);
	
		return $picPath;
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
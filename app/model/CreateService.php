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

			$stickers = json_decode($dataPics->stickersData[$stickersKey], true);
			$uploadedFiles[] = $this->processImageWithStickers($imageData, $stickers);
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

	private function processImageWithStickers($imageData, $stickers) {
		$image = imagecreatefrompng($imageData['tmp_name']);
		
		if (!$image)
			throw new Exception("Failed to load image");
	
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
		$stickersPath = STICKERS_PATH . basename($sticker['src']);
		$stickerImage = imagecreatefrompng($stickersPath);
		
		if (!$stickerImage)
			throw new Exception("Failed to load sticker: " . $sticker['src']);
	
		$stickerWidth = floatval($sticker['width']);
		$stickerHeight = floatval($sticker['height']);
		$stickerLeft = floatval($sticker['left']);
		$stickerTop = floatval($sticker['top']);
	
		imagecopyresampled(
			$image, $stickerImage,
			$stickerLeft, $stickerTop,
			0, 0,
			$stickerWidth, $stickerHeight,
			imagesx($stickerImage), imagesy($stickerImage)
		);
	
		imagedestroy($stickerImage);
	}
}
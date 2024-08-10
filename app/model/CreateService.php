<?php

class CreateService {
	public CreateRepository $repository;
	public AuthService $authService;

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

		// prettyPrint($dataPics);
		echo("\n\n");

		foreach ($dataPics->image as $imagesKey => $imageData) {
			$stickersKey = 'stickersData_' . str_replace('canvas_', '', $imagesKey);

			// prettyPrint($imagesKey);

			if (isset($dataPics->stickersData[$stickersKey])) {
				$stickers = json_decode($dataPics->stickersData[$stickersKey], true);
	
				$uploadedFiles[] = $this->processImageWithStickers($imageData, $stickers);
			}
			else
				echo "HERE";
		}
	}

	private function processImageWithStickers($imageData, $stickers) {
		// Charger l'image de base depuis le fichier temporaire
		$image = imagecreatefrompng($imageData['tmp_name']);
		
		if (!$image) {
			throw new Exception("Failed to load image");
		}
	
		// Appliquer les stickers
		foreach ($stickers as $sticker) {
			$this->applySticker($image, $sticker);
		}
	
		// Enregistrer ou retourner l'image résultante
		$outputFile = UPLOAD_ABSOLUTE_PATH . uniqid() . '.png';
		imagepng($image, $outputFile);
	
		// Libérer la mémoire
		imagedestroy($image);
	
		return $outputFile;
	}

	private function applySticker($image, $sticker) {
		// Charger le sticker depuis son URL


		$stickerImage = imagecreatefrompng($sticker['src']);
		
		if (!$stickerImage) {
			throw new Exception("Failed to load sticker: " . $sticker['src']);
		}
	
		// Calculer la position et la taille
		$stickerWidth = intval($sticker['width']);
		$stickerHeight = intval($sticker['height']);
		$stickerLeft = intval($sticker['left']);
		$stickerTop = intval($sticker['top']);
	
		// Appliquer le sticker sur l'image de base
		imagecopyresampled(
			$image, $stickerImage,
			$stickerLeft, $stickerTop,
			0, 0,
			$stickerWidth, $stickerHeight,
			imagesx($stickerImage), imagesy($stickerImage)
		);
	
		// Libérer la mémoire utilisée par le sticker
		imagedestroy($stickerImage);
	}
	


}
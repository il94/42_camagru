import { createPicMini } from "./pic.js";

/* ANGLE POPUP */

const createButton = document.getElementsByClassName("create-button")[0];
createButton.style.display = 'none'

const settingsButton = document.getElementById("settings-button");
settingsButton?.addEventListener('click', () => {
	window.location.href = "index.php?page=settings";
})

const logoutButton = document.getElementById("logout-button");
logoutButton?.addEventListener('click', () => {
	const xhr = new XMLHttpRequest();
	xhr.open('POST', `index.php?page=auth&route=logout`, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	xhr.onreadystatechange = () => {
		if (xhr.readyState === 4) {
			if (xhr.status === 201) {
				window.location.href = "index.php?page=auth&route=login";
			}
			else {
				console.error("ERROR", xhr.responseText);
			}
		}
	}

	xhr.send();
})

/* PICS */

function getRandomColor() {
	const r = Math.floor(Math.random() * 256);
	const g = Math.floor(Math.random() * 256);
	const b = Math.floor(Math.random() * 256);

	const color = `rgba(${r}, ${g}, ${b}, 0.5)`

	return (color);
}

const pics = document.getElementsByClassName('pic')

const randomColor = getRandomColor()
for (const pic of pics) {

	// Applique une couleur random a la pic
	pic.style.backgroundColor = randomColor;

	const likeButton = pic.querySelector(".like-button")
	if (likeButton) {
		likeButton.addEventListener('click', () => {
			likeButton.classList.toggle("like")
			likeButton.classList.toggle("selected")
		})
	}
}

/* ================ CREATE PIC ================ */

const picModel = document.getElementById('pic-model')
const picBodyRecto = picModel.querySelector(".pic-body-recto");
const previewBar = document.getElementById("preview-bar")
const previewBar2 = document.getElementById("previews")
const cameraButtons = document.getElementsByClassName("camera-button");

const canvas = document.getElementById("canvas");
const context = canvas.getContext("2d");
const PICSIZE = 400

let stickerSelected;
const stickersList = document.getElementsByClassName("sticker")
for (const sticker of stickersList) {
    sticker.addEventListener('click', (event) => {

		// Selectionne le sticker
        stickerSelected = event.target;

		// Defini la version svg du sticker pour le cursor
		const svg = stickerSelected.src.replace(".png", ".svg")
        video.style.cursor = `url('${svg}') ${sticker.width / 2} ${sticker.height / 2}, auto`;
        galleryImage.style.cursor = `url('${svg}') ${sticker.width / 2} ${sticker.height / 2}, auto`;
    });
}

const video = picModel.querySelector("#video");

const onOffButtons = document.getElementsByClassName('onoff-button');
const cameraOffScreen = document.getElementById('camera-off');

const galleryImage = document.getElementById('gallery-image');
const galleryButtons = document.getElementsByClassName('gallery-button');
const inputFile = document.getElementById('input-file');

let stream
try {
	stream = await navigator.mediaDevices.getUserMedia({ video: true })

	video.srcObject = stream;
	video.play();
	video.style.display = 'block'
	clearStickers()

	for (const button of cameraButtons) {
		button.classList.remove('blocked')
	}
	for (const button of onOffButtons) {
		button.classList.add('success')
	}
}
catch (error) {
	console.error("Error accessing the camera: " + error);
}

for (const button of onOffButtons) {
	button?.addEventListener('click', async () => {
		if (stream) {
			const tracks = stream.getTracks();
			tracks.forEach(track => track.stop());
			stream = null
			
			video.style.display = 'none'
			galleryImage.style.display = 'none';
			cameraOffScreen.style.display = 'flex'

			for (const button of cameraButtons) {
				button.classList.add('blocked')
			}
			for (const button of onOffButtons) {
				button.classList.add('error')
				button.classList.remove('success')
			}
		}
		else {
			try {
				stream = await navigator.mediaDevices.getUserMedia({ video: true })
			
				video.srcObject = stream;
				video.play();

				galleryImage.style.display = 'none';
				cameraOffScreen.style.display = 'none'
				video.style.display = 'block'
				clearStickers()

				inputFile.value = ''

				for (const button of cameraButtons) {
					button.classList.remove('blocked')
				}
				for (const button of onOffButtons) {
					button.classList.add('success')
					button.classList.remove('error')
				}
			}
			catch (error) {
				console.error("Error accessing the camera: " + error);
			}
		}
	})
}

for (const button of galleryButtons) {
	button?.addEventListener('click', () => {
		inputFile.click()
	})
}

inputFile.addEventListener('change', (event) => {
    const fileInput = event.target;
    const file = fileInput.files[0];

    if (file) {
			const reader = new FileReader();

			reader.onload = function(e) {

			galleryImage.src = e.target.result;

			if (stream) {
				const tracks = stream.getTracks();
				tracks.forEach(track => track.stop());
				stream = null
			}
	
			cameraOffScreen.style.display = 'none'
			video.style.display = 'none'
			galleryImage.style.display = 'block';
			clearStickers()

			for (const button of cameraButtons) {
				button.classList.remove('blocked')
			}
			for (const button of onOffButtons) {
				button.classList.add('error')
				button.classList.remove('success')
			}

        };

        reader.readAsDataURL(file);
    }
});

// Place les stickers sur l'image
function drawStickers(element, size, size2) {
	const elementRect = element.getBoundingClientRect();

	const clickX = event.clientX - elementRect.left;
	const clickY = event.clientY - elementRect.top;

	const img = document.createElement('img');
	img.src = stickerSelected.src;
	img.className = 'sticker';
	img.style.position = 'absolute';

	const stickerWidthPx = stickerSelected.width * (elementRect.width / PICSIZE);
   const stickerHeightPx = stickerSelected.height * (elementRect.height / PICSIZE);

	// Rendu direct front
	img.style.left = `${clickX - stickerWidthPx / 2}px`;
   img.style.top = `${clickY - stickerHeightPx / 2}px`;
	img.style.width = `${stickerWidthPx}px`;
	img.style.height = `${stickerHeightPx}px`;

	const halfStickerWidth = stickerSelected.width / 2 * size / PICSIZE
	const offsetX = (size2 - size) / 2
	const newClickX = (event.clientX - elementRect.left) * size / PICSIZE

	// Rendu back
	img.baseLeft = `${newClickX + offsetX - halfStickerWidth}px`;
	img.baseTop = `${(clickY - stickerHeightPx / 2) * (size / elementRect.height)}px`;
	img.baseWidth = `${stickerSelected.width * (size / PICSIZE)}px`;
	img.baseHeight = `${stickerSelected.height * (size / PICSIZE)}px`;

	picBodyRecto.appendChild(img);
}

video.addEventListener('click', () => drawStickers(video, PICSIZE, PICSIZE))
galleryImage.addEventListener('click', () => drawStickers(galleryImage, galleryImage.naturalHeight, galleryImage.naturalWidth))

for (const cameraButton of cameraButtons) {
	cameraButton.addEventListener("click", () => {
		if (cameraButton.classList.contains("blocked"))
			return

		const xhr = new XMLHttpRequest();
		xhr.open('POST', `index.php?page=create`, true);
		xhr.setRequestHeader('Content-Type', 'application/json');

		// Dessine la photo prise
		context.save();
		context.scale(-1, 1);
		context.drawImage(video, -canvas.width, 0, canvas.width, canvas.height);
		context.restore();

		const squareCanvas = document.createElement('canvas');
		const squareContext = squareCanvas.getContext('2d');
		const galleryCanvas = document.createElement('canvas');
		const galleryContext = galleryCanvas.getContext('2d');

		if (video.style.display === 'block') {
			// Crop la photo (rectangle -> carré)
			squareCanvas.width = PICSIZE;
			squareCanvas.height = PICSIZE;

			const offsetX = (canvas.width - PICSIZE) / 2;
			const offsetY = (canvas.height - PICSIZE) / 2;
	
			squareContext.drawImage(canvas, offsetX, offsetY, PICSIZE, PICSIZE, 0, 0, PICSIZE, PICSIZE);
		}
		else if (galleryImage.style.display === 'block') {
			galleryCanvas.width = galleryImage.naturalWidth;
			galleryCanvas.height = galleryImage.naturalHeight;

			galleryContext.drawImage(galleryImage, 0, 0, galleryCanvas.width, galleryCanvas.height);	
		}

		let imageDataToSend
		if (video.style.display === 'block')
			imageDataToSend = squareCanvas.toDataURL('image/png');
		else if (galleryImage.style.display === 'block')
			imageDataToSend = galleryCanvas.toDataURL('image/png');

		// Data des stickers a placer
		const stickersData = Array.from(document.querySelectorAll('.pic-body-recto .sticker')).map(sticker => {

			const x = parseFloat(sticker.baseLeft);
			const y = parseFloat(sticker.baseTop);
			const width = parseFloat(sticker.baseWidth);
			const height = parseFloat(sticker.baseHeight);

			if (video.style.display === 'block')
				squareContext.drawImage(sticker, x, y, width, height);
			else if (galleryImage.style.display === 'block')
				galleryContext.drawImage(sticker, x, y, width, height);

			return {
				src: sticker.src,
				left: sticker.baseLeft,
				top: sticker.baseTop,
				width: sticker.baseWidth,
				height: sticker.baseHeight
			}
		});

		let imageDataPreview
		if (video.style.display === 'block')
			imageDataPreview = squareCanvas.toDataURL('image/png');
		else if (galleryImage.style.display === 'block')
			imageDataPreview = galleryCanvas.toDataURL('image/png');
  
		xhr.onreadystatechange = () => {
			if (xhr.readyState === 4) {
				if (xhr.status === 201) {
					const response = JSON.parse(xhr.responseText)

					previewBar.appendChild(createPicMini(imageDataPreview))
					previewBar2.appendChild(createPicMini(imageDataPreview))
		
					previewBar.appendChild(createPicMini(response))
					previewBar2.appendChild(createPicMini(response))
				}
				else {
					console.log("ERROR")
				}
			}
		};

		const postData = JSON.stringify({
			imageUrl: imageDataToSend,
			stickers: stickersData
		});
		xhr.send(postData);
	});
}

function clearStickers() {
	const currentStickers = picBodyRecto.querySelectorAll('.sticker');

	currentStickers.forEach((sticker) => {
		picBodyRecto.removeChild(sticker);
  });

  stickerSelected = null
  video.style.cursor = 'default'
  galleryImage.style.cursor = 'default'

}

/* BUTTONS */

const stickersButton = document.getElementById('stickers-button')
const previewsButton = document.getElementById('previews-button')
const stickers = document.getElementById('stickers')
const previews = document.getElementById('previews')

stickers.classList.add("show")
stickersButton.addEventListener('click', () => {
	stickers.classList.add("show")
	previews.classList.remove("show")
})
previewsButton.addEventListener('click', () => {
	previews.classList.add("show")
	stickers.classList.remove("show")
})

const logo = document.querySelector('.logo');
const mobileHomeButton = document.getElementById('mobile-home-button');
const cancelButtons = document.getElementsByClassName('cancel-button');
const returnHomeButtons = [
	logo,
	mobileHomeButton,
	...cancelButtons
]
returnHomeButtons.forEach((button) => {
	button?.addEventListener('click', () => {
		window.location.href = "index.php?page=home";
	})
})
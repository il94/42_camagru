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

async function handlePanel(button) {
	video.style.display = 'none'
	galleryImage.style.display = 'none';
	previewImage.style.display = 'none';
	cameraOffScreen.style.display = 'none';
	clearStickers()

	for (const button of cameraButtons) {
		button.classList.add('blocked')
	}
	for (const button of onOffButtons) {
		button.classList.add('error')
		button.classList.remove('success')
	}
	trashButton.style.display = 'none'

	if (button == 'onoff') {
		if (!stream) {
			try {
				cameraOffScreen.style.display = 'flex';
				stream = await navigator.mediaDevices.getUserMedia({ video: true })
			
				video.srcObject = stream;
				video.play();

				video.style.display = 'block'
				cameraOffScreen.style.display = 'none';
				for (const button of onOffButtons) {
					button.classList.add('success')
				}
				for (const button of cameraButtons) {
					button.classList.remove('blocked')
				}
			}
			catch (error) {
				console.error("Error accessing the camera: " + error);
			}
		}
		else {
			const tracks = stream.getTracks();
			tracks.forEach(track => track.stop());
			stream = null
			
			cameraOffScreen.style.display = 'flex';
		}
	}
	else {
		if (stream) {
			const tracks = stream.getTracks();
			tracks.forEach(track => track.stop());
			stream = null
		}

		if (button == 'gallery') {
			galleryImage.style.display = 'block';
			for (const button of cameraButtons) {
				button.classList.remove('blocked')
			}
		}
		else if (button == 'preview') {
			previewImage.style.display = 'block';
			trashButton.style.display = 'block'
		}
	}
}

const picModel = document.getElementById('pic-model')
const picBodyRecto = picModel.querySelector(".pic-body-recto");
const previewBar = document.getElementById("preview-bar")
const previewBar2 = document.getElementById("previews")
const cameraButtons = document.getElementsByClassName("camera-button");
const trashButton = document.getElementById("trash");

const canvas = document.getElementById("canvas");
const context = canvas.getContext("2d");
const PICSIZE = 400

let stickerSelected;
const stickersList = document.getElementsByClassName("sticker")
for (const sticker of stickersList) {
	sticker.addEventListener('click', (event) => {
		stickerSelected = event.target;

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

const previewImage = document.getElementById('preview-image');

const publishButtons = document.getElementsByClassName('publish-button');

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
		handlePanel('onoff')
		inputFile.value = ''
	})
}

for (const button of galleryButtons) {
	button?.addEventListener('click', () => {
		inputFile.click()
	})
}

const picMinis = document.getElementsByClassName('pic mini')
trashButton.addEventListener('click', () => {
	if (previewImage.style.display !== 'block')
		return

	for (const picMini of picMinis) {
		const preview = picMini.querySelector(".preview")
		if (preview.src === previewImage.src)
			picMini.remove()
	}

	handlePanel('onoff')
})

inputFile.addEventListener('change', (event) => {
    const fileInput = event.target;
    const file = fileInput.files[0];

    if (file) {
			const reader = new FileReader();

			reader.onload = function(e) {

			galleryImage.src = e.target.result;

			handlePanel('gallery')
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

const canvasList = []

const model = {
	stickersData: false,
	canvas: false
}
const previewBars = [previewBar, previewBar2]

for (const cameraButton of cameraButtons) {
	cameraButton.addEventListener("click", () => {
		if (cameraButton.classList.contains("blocked"))
			return

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

		// Data des stickers a placer
		const stickersToDraw = Array.from(document.querySelectorAll('.pic-body-recto .sticker'))

		const stickersData = stickersToDraw.map(sticker => {
			return {
				src: sticker.src,
				left: sticker.baseLeft,
				top: sticker.baseTop,
				width: sticker.baseWidth,
				height: sticker.baseHeight
			}
		});

		function copyCanvas(originalCanvas) {
			const newCanvas = document.createElement('canvas');
			newCanvas.width = originalCanvas.width;
			newCanvas.height = originalCanvas.height;
			const ctx = newCanvas.getContext('2d');
			ctx.drawImage(originalCanvas, 0, 0);
			return newCanvas;
	  }

		if (video.style.display === 'block') {
			canvasList.push({
				stickersData: stickersData,
				canvas: copyCanvas(squareCanvas)
			})
		}
		else if (galleryImage.style.display === 'block') {
			canvasList.push({
				stickersData: stickersData,
				canvas: copyCanvas(galleryCanvas)
			})
		}

		stickersToDraw.forEach(sticker => {
			const x = parseFloat(sticker.baseLeft);
			const y = parseFloat(sticker.baseTop);
			const width = parseFloat(sticker.baseWidth);
			const height = parseFloat(sticker.baseHeight);

			if (video.style.display === 'block')
				squareContext.drawImage(sticker, x, y, width, height);
			else if (galleryImage.style.display === 'block')
				galleryContext.drawImage(sticker, x, y, width, height);
		});

		let imageDataPreview
		if (video.style.display === 'block')
			imageDataPreview = squareCanvas.toDataURL('image/png');
		else if (galleryImage.style.display === 'block')
			imageDataPreview = galleryCanvas.toDataURL('image/png');

		for (const bar of previewBars) {
			const picMini = createPicMini(imageDataPreview)

			const preview = picMini.querySelector(".preview");
			preview.addEventListener('click', () => {
				previewImage.src = imageDataPreview;

				handlePanel('preview')
			})

			bar.appendChild(picMini)
		}
		for (const button of publishButtons) {
			button.classList.remove('blocked')
		}
	});
}

for (const publishButton of publishButtons) {
	
	publishButton.addEventListener("click", async () => {
		if (publishButton.classList.contains("blocked"))
			return

		const formData = new FormData()
		const promises = [];

		canvasList.forEach((canvas, index) => {
			 // Ajouter les données des stickers
  
			 // Convertir le canvas en blob et ajouter au FormData
			 const promise = new Promise((resolve, reject) => {
					formData.append(`stickersData_${index}`, JSON.stringify(canvas.stickersData));

				  canvas.canvas.toBlob((blob) => {
						if (blob) {
							 formData.append(`canvas_${index}`, blob, `canvas_${index}.png`);
							 resolve();
						} else {
							 reject(new Error('Failed to create blob'));
						}
				  }, 'image/png', 1);
			 });
  
			 // Ajouter la promesse à la liste des promesses
			 promises.push(promise);
		});

		try {
			await Promise.all(promises);


			for (let [key, value] of formData.entries()) {
				if (value instanceof Blob) {
					 console.log(`${key}: [Blob]`, value);
				} else {
					 console.log(`${key}:`, value);
				}
		  }




		const xhr = new XMLHttpRequest();
		xhr.open('POST', `index.php?page=create`, true);

		xhr.onreadystatechange = () => {
			if (xhr.readyState === 4) {
				if (xhr.status === 201) {
					// const response = JSON.parse(xhr.responseText)

					console.log("OK")

					window.location.href = "index.php?page=home";
				}
				else {
					console.log("ERROR")
				}
			}
		};

		console.log("HEER")

		for (const entry of formData.entries()) {
			console.log("ENRTY ", entry)
		}

		xhr.send(formData);
		}
		catch (error) {
			//jsp
		}
	})
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
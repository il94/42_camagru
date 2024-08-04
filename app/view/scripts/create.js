import { createPicMini } from "./pic.js";

/* ANGLE POPUP */

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
    });
}

const video = picModel.querySelector("#video");
try {
	const stream = await navigator.mediaDevices.getUserMedia({ video: true })

	video.srcObject = stream;
	video.play();
}
catch (error) {
	console.error("Error accessing the camera: " + error);
}

// Place les stickers sur l'image
video.addEventListener('click', (event) => {
	const videoRect = video.getBoundingClientRect();

	const clickX = event.clientX - videoRect.left;
	const clickY = event.clientY - videoRect.top;

	const img = document.createElement('img');
	img.src = stickerSelected.src;
	img.className = 'sticker';
	img.style.position = 'absolute';

	const stickerWidthPx = stickerSelected.width * (videoRect.width / PICSIZE);
    const stickerHeightPx = stickerSelected.height * (videoRect.height / PICSIZE);

	// Rendu front
	img.style.left = `${clickX - stickerWidthPx / 2}px`;
    img.style.top = `${clickY - stickerHeightPx / 2}px`;
	img.style.width = `${stickerWidthPx}px`;
	img.style.height = `${stickerHeightPx}px`;

	// Rendu back
	img.baseLeft = `${(clickX - stickerWidthPx / 2) * (PICSIZE / videoRect.width)}px`;
	img.baseTop = `${(clickY - stickerHeightPx / 2) * (PICSIZE / videoRect.height)}px`;
	img.baseWidth = `${stickerSelected.width}px`;
	img.baseHight = `${stickerSelected.height}px`;

	picBodyRecto.appendChild(img);
})

for (const cameraButton of cameraButtons) {
	cameraButton.addEventListener("click", () => {

		const xhr = new XMLHttpRequest();
		xhr.open('POST', `index.php?page=create`, true);
		xhr.setRequestHeader('Content-Type', 'application/json');

		// Dessine la photo prise
		context.save();
		context.scale(-1, 1);
		context.drawImage(video, -canvas.width, 0, canvas.width, canvas.height);
		context.restore();

		// Crop la photo (rectangle -> carré)
		const squareCanvas = document.createElement('canvas');
		squareCanvas.width = PICSIZE;
		squareCanvas.height = PICSIZE;
		
		const offsetX = (canvas.width - PICSIZE) / 2;
        const offsetY = (canvas.height - PICSIZE) / 2;

		const squareContext = squareCanvas.getContext('2d');
		squareContext.drawImage(canvas, offsetX, offsetY, PICSIZE, PICSIZE, 0, 0, PICSIZE, PICSIZE);

        const imageData = squareCanvas.toDataURL('image/png');

		// Data des stickers a placer
        const stickersData = Array.from(document.querySelectorAll('.pic-body-recto .sticker')).map(sticker => {
			return {
				src: sticker.src,
				left: sticker.baseLeft,
				top: sticker.baseTop,
				width: sticker.baseWidth,
				height: sticker.baseHight
			}
        });

		xhr.onreadystatechange = () => {
			if (xhr.readyState === 4) {
				if (xhr.status === 201) {
					const response = JSON.parse(xhr.responseText)

					previewBar.appendChild(createPicMini(response))
					previewBar2.appendChild(createPicMini(response))
				}
				else {
					console.log("ERROR")
				}
			}
		};

		const postData = JSON.stringify({
			imageUrl: imageData,
			stickers: stickersData
		});
		xhr.send(postData);
	});
}

/* BUTTONS */

const logo = document.querySelector('.logo');
const mobileHomeButton = document.getElementById('mobile-home-button');
const returnTopButtons = [
	logo,
	mobileHomeButton
]
returnTopButtons.forEach((button) => {
	button?.addEventListener('click', () => {
		window.location.href = "index.php?page=home";
	})
})

const createButton = document.getElementsByClassName("create-button")[0];
createButton.style.display = 'none'

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
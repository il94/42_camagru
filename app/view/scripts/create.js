// const form = document.getElementById("form")

import { createPicMini } from "./pic.js";

// form.addEventListener('click', () => {
// 	const fileInput = form.querySelector(`#file-input`);

// 	// fileInput.addEventListener('change', (event) => {
// 	// 	const file = event.target.files[0];

// 	// 	if (file) {
// 	// 		const reader = new FileReader();
// 	// 		reader.onload = function(e) {
// 	// 			avatarField.src = e.target.result;
// 	// 		};
// 	// 		reader.readAsDataURL(file);
// 	// 	}
// 	// });

// 	const file = fileInput.files[0];

// 	if (!file) {
// 		// formErrorMessage.textContent = 'Please select a file.';
// 		return;
// 	}

// 	const xhr = new XMLHttpRequest();
// 	xhr.open('POST', `index.php?page=create`, true);
// 	xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

// 	xhr.onreadystatechange = () => {
// 		if (xhr.readyState === 4) {
// 			if (xhr.status === 201) {
// 				console.log("OK")

// 				// window.location.href = `index.php?page=settings&state=updated&data=avatar`;
// 			}
// 			else {
// 				console.log("ERROR")
// 				// const response = JSON.parse(xhr.responseText);

// 				// formErrorMessage.textContent = response.message
// 			}
// 		}
// 	};

// 	const formData = new FormData();
// 	formData.append('pic', file);
// 	xhr.send(formData);
// })















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

/* CREATE PIC */

const picModel = document.getElementById('pic-model')

const video = picModel.querySelector("#video");
navigator.mediaDevices.getUserMedia({ video: true })
	.then(stream => {
		video.srcObject = stream;
		video.play();
	})
	.catch(err => {
		console.error("Error accessing the camera: " + err);
});

const canvas = document.getElementById("canvas");
const context = canvas.getContext("2d");
const capturedPhoto = document.getElementById("captured-photo");

const previewBar = document.getElementById("preview-bar")
const previewBar2 = document.getElementById("previews")

const cameraButtons = document.getElementsByClassName("camera-button");
for (const cameraButton of cameraButtons) {

	cameraButton.addEventListener("click", () => {
		const xhr = new XMLHttpRequest();
		xhr.open('POST', `index.php?page=create`, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	
		context.save();
		context.scale(-1, 1);
		context.drawImage(video, -canvas.width, 0, canvas.width, canvas.height);
		context.restore();
		
		const imageData = canvas.toDataURL("image/png");

		xhr.onreadystatechange = () => {
			if (xhr.readyState === 4) {
				if (xhr.status === 201) {
					console.log("OK")
					capturedPhoto.src = imageData;
					previewBar.appendChild(createPicMini(imageData))
					previewBar2.appendChild(createPicMini(imageData))
				}
				else {
					console.log("ERROR")
				}
			}
		};

		const postData = `pic=${encodeURIComponent(imageData)}`
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
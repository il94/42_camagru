/* CREATE BUTTON */

const createButtons = document.getElementsByClassName("create-button");
for (const createButton of createButtons) {
	createButton.addEventListener('click', () => {
		window.location.href = "index.php?page=create";
	})
}

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

// Suppression
const deletePopup = document.getElementById('delete-popup');
const deletePicForm = document.getElementById('delete-pic-form');

const closeDeletePopup = document.getElementById('close-delete-popup')
closeDeletePopup?.addEventListener('click', () => {
	deletePopup.style.display = 'none';
})

deletePicForm?.addEventListener('submit', (event) => {
	event.preventDefault()

	const picId = deletePopup.getAttribute('picId')

	const xhr = new XMLHttpRequest();
	xhr.open('DELETE', `index.php?page=home&picId=${picId}`, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	xhr.onreadystatechange = () => {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				const pics = Array.from(document.getElementsByClassName('pic'));
				const pic = pics.find((pic) => pic.id === picId)

				pic.remove()
				deletePopup.style.display = 'none';
			}
			else {
				console.error("ERROR", xhr.responseText);
			}
		}
	}

	xhr.send();
})

/* AUTH BUTTON GUEST */

const authButtons = document.getElementsByClassName("auth-button");
for (const authButton of authButtons) {
	authButton?.addEventListener('click', () => {
		window.location.href = "/";
	})
}

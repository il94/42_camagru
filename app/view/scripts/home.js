/* CREATE BUTTON */

const createbutton = document.getElementsByClassName("create-button")[0];

createbutton.addEventListener('click', () => {
	window.location.href = "index.php?page=create";
})

/* ANGLE POPUP */

const logoutButton = document.getElementById("logout-button");

logoutButton.addEventListener('click', () => {
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

const settingsButton = document.getElementById("settings-button");

settingsButton.addEventListener('click', () => {
	window.location.href = "index.php?page=settings";
})

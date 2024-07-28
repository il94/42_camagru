const profilePopup = document.getElementById("angle-popup-profile")
const profileButton = document.getElementById("profile-button")
if (profilePopup && profileButton) {

	profilePopup.style.display = "none"
	
	profileButton.addEventListener('click', () => {
		profilePopup.style.display = profilePopup.style.display === "none" ? "block" : "none"
	})

	document.addEventListener('click',(event) => {
		if (
			!profilePopup.contains(event.target) &&
			!profileButton.contains(event.target))
		{
			profilePopup.style.display = "none"
		}
	})
}

const desktopNavbarIcons = document.getElementById("desktop-navbar-icons")
const logoutHiddenButton = document.getElementById("logout-hidden-button")
if (desktopNavbarIcons && logoutHiddenButton) {
	desktopNavbarIcons.addEventListener('mouseenter', () => {
		logoutHiddenButton.style.display = 'block';
		setTimeout(() => {
			logoutHiddenButton.classList.add('show');
		}, 10);
	});

	desktopNavbarIcons.addEventListener('mouseleave', () => {
		logoutHiddenButton.classList.remove('show');
		setTimeout(() => {
			if (!logoutHiddenButton.classList.contains('show')) {
				logoutHiddenButton.style.display = 'none';
			}
		}, 600);

	})

	logoutHiddenButton.addEventListener('click', () => {
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
}
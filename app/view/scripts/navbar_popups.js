const profilePopup = document.getElementById("angle-popup-profile")
const profileButton = document.getElementById("profile-button")
const mobileProfileButton = document.getElementById("mobile-profile-button")

if (profilePopup && (profileButton || mobileProfileButton)) {

	profilePopup.style.display = "none"
	
	profileButton?.addEventListener('click', () => {
		profilePopup.style.display = profilePopup.style.display === "none" ? "block" : "none"
	})
	mobileProfileButton?.addEventListener('click', () => {
		profilePopup.style.display = profilePopup.style.display === "none" ? "block" : "none"
	})
	document.addEventListener('click',(event) => {
		if (
			!profilePopup.contains(event.target) &&
			!profileButton.contains(event.target) &&
			!mobileProfileButton.contains(event.target))
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
		const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

		const xhr = new XMLHttpRequest();
		xhr.open('POST', `/logout`, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.setRequestHeader('X-CSRF-Token', csrfToken);

		xhr.onreadystatechange = () => {
			if (xhr.readyState === 4) {
				if (xhr.status === 201) {
					window.location.href = "/login";
				}
				else {
					console.error("ERROR", xhr.responseText);
				}
			}
		}

		xhr.send();
	})
}

const mobileLogoutButton = document.getElementById("mobile-logout-button")
if (mobileLogoutButton) {

	mobileLogoutButton.addEventListener('click', () => {
		const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

		const xhr = new XMLHttpRequest();
		xhr.open('POST', `/logout`, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.setRequestHeader('X-CSRF-Token', csrfToken);

		xhr.onreadystatechange = () => {
			if (xhr.readyState === 4) {
				if (xhr.status === 201) {
					window.location.href = "/login";
				}
				else {
					console.error("ERROR", xhr.responseText);
				}
			}
		}

		xhr.send();
	})
}
// const searchPopup = document.getElementById("search-popup")

// const notificationPopup = document.getElementById("angle-popup-notification")
const profilePopup = document.getElementById("angle-popup-profile")
const desktopNavbarIcons = document.getElementById("desktop-navbar-icons")

// const loopButton = document.getElementById("loop-button")
// const notificationButton = document.getElementById("notification-button")
const profileButton = document.getElementById("profile-button")
const logoutHiddenButton = document.getElementById("logout-hidden-button")

// searchPopup.style.display = "none"

// notificationPopup.style.display = "none"
profilePopup.style.display = "none"

// loopButton.addEventListener('click', () => {

// 	searchPopup.style.display = searchPopup.style.display === "none" ? "flex" : "none"

// 	notificationPopup.style.display = "none"
// 	profilePopup.style.display = "none"
// })

// notificationButton.addEventListener('click', () => {

// 	searchPopup.style.display = "none"
	
// 	notificationPopup.style.display = notificationPopup.style.display === "none" ? "block" : "none"
// 	profilePopup.style.display = profilePopup.style.display === "block" && "none"

// })

profileButton.addEventListener('click', () => {

	// searchPopup.style.display = "none"

	profilePopup.style.display = profilePopup.style.display === "none" ? "block" : "none"
	// notificationPopup.style.display = notificationPopup.style.display === "block" && "none"

})

desktopNavbarIcons.addEventListener('mouseenter', () => {
	logoutHiddenButton.style.display = 'block';
    setTimeout(() => {
        logoutHiddenButton.classList.add('show');
    }, 10); // small delay to allow display change to take effect})
});

desktopNavbarIcons.addEventListener('mouseleave', () => {
	logoutHiddenButton.classList.remove('show');
    setTimeout(() => {
        if (!logoutHiddenButton.classList.contains('show')) {
            logoutHiddenButton.style.display = 'none';
        }
    }, 600); // match the transition duration

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

// const input = document.getElementById("search-popup-input")

// input.addEventListener('click', () => {
// 	input.placeholder = ""
// })

// input.addEventListener('blur', (event) => {
// 	if (!event.target.value)
// 		input.placeholder = "Search a user..."
// })

document.addEventListener('click',(event) => {
	if (
		// !searchPopup.contains(event.target) &&
		// !notificationPopup.contains(event.target) &&
		!profilePopup.contains(event.target) &&
		// !loopButton.contains(event.target) &&
		// !notificationButton.contains(event.target) &&
		!profileButton.contains(event.target))
	{
		// searchPopup.style.display = "none"
		// notificationPopup.style.display = "none"
		profilePopup.style.display = "none"
	}
})
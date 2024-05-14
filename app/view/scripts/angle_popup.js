const anglePopup = document.getElementById("angle-popup")

const notificationPopup = document.getElementById("angle-popup-notification")
const profilePopup = document.getElementById("angle-popup-profile")

const notificationButton = document.getElementById("notification-button")
const profileButton = document.getElementById("profile-button")

anglePopup.style.display = "none"
notificationPopup.style.display = "none"
profilePopup.style.display = "none"

notificationButton.addEventListener('click', () => {

	anglePopup.style.display = notificationPopup.style.display === "none" ? "flex" : "none"
	profilePopup.style.display = profilePopup.style.display === "block" && "none"
	notificationPopup.style.display = "block"

})

profileButton.addEventListener('click', () => {

	anglePopup.style.display = profilePopup.style.display === "none" ? "flex" : "none"
	notificationPopup.style.display = notificationPopup.style.display === "block" && "none"
	profilePopup.style.display = "block"

})

const input = document.getElementById("search-popup-input")

input.addEventListener('click', () => {
	input.placeholder = ""
})

input.addEventListener('blur', (event) => {
	if (!event.target.value)
		input.placeholder = "Search a user..."
})
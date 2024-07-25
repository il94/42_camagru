// const searchPopup = document.getElementById("search-popup")

// const notificationPopup = document.getElementById("angle-popup-notification")
const profilePopup = document.getElementById("angle-popup-profile")

// const loopButton = document.getElementById("loop-button")
// const notificationButton = document.getElementById("notification-button")
const profileButton = document.getElementById("profile-button")

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
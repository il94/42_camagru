const anglePopup = document.getElementById("angle-popup")
const notificationButton = document.getElementById("notification-button")
const profileButton = document.getElementById("profile-button")

console.log(anglePopup)
console.log(notificationButton)
console.log(profileButton)

profileButton.addEventListener('click', () => {
	if (anglePopup.style.display === "none")
		anglePopup.style.display = "flex"
	else
		anglePopup.style.display = "none"
})

const input = document.getElementById("search-popup-input")

input.addEventListener('click', () => {
	input.placeholder = ""
})

input.addEventListener('blur', (event) => {
	if (!event.target.value)
		input.placeholder = "Search a user..."
})
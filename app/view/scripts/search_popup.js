const searchPopup = document.getElementById("search-popup")
const loopButton = document.getElementById("loop-button")

loopButton.addEventListener('click', () => {
	if (searchPopup.style.display === "none")
		searchPopup.style.display = "flex"
	else
		searchPopup.style.display = "none"
})

const input = document.getElementById("search-popup-input")

input.addEventListener('click', () => {
	input.placeholder = ""
})

input.addEventListener('blur', (event) => {
	if (!event.target.value)
		input.placeholder = "Search a user..."
})
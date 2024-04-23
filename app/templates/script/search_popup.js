const input = document.getElementById("search-popup-input");

input.addEventListener('click', () => {
	input.placeholder = ""
})

input.addEventListener('blur', (event) => {
	if (!event.target.value)
		input.placeholder = "Search a user..."
})
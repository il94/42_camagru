const inputs = document.getElementsByClassName("input")

for (const input of inputs) {

	const inputText = input.querySelector(".input-text");

	// Deplacments du placeholder
	const placeHolder = input.querySelector(".input-placeholder");

	// Reduit le placeholder au clic sur la zone de texte
	inputText.addEventListener('focus', () => {
		if (!placeHolder.classList.contains(".input-reduce"))
			placeHolder.classList.add("input-reduce");
	})
	
	// Si la zone de texte est vide, recentre le placeholder
	inputText.addEventListener('blur', (event) => {
		if (!event.target.value)
			placeHolder.classList.remove("input-reduce");
	})

	// Si un bouton show est present, gere son comportement
	const showButton = input.querySelector(".show-button");
	if (showButton) {
		const showIcon = input.querySelector(".show-icon");
		const hiddenIcon = input.querySelector(".hidden-icon");

		showIcon.style.display = "block";
		hiddenIcon.style.display = "none";

		showButton.addEventListener('click', () => {
			if (inputText.type === "password") {
				inputText.type = "text";
				showIcon.style.display = "none";
				hiddenIcon.style.display = "block";
			}
			else {
				inputText.type = "password";
				showIcon.style.display = "block";
				hiddenIcon.style.display = "none";
			}
		})
	}
}
const buttonIcons = document.getElementsByClassName("button-icon")

for (const buttonIcon of buttonIcons) {

	const icons = buttonIcon.querySelectorAll(".icon")

	buttonIcon.addEventListener('click', () => {

		if (buttonIcon.classList.contains("selectable"))
		{	
			if (buttonIcon.classList.contains("selected"))
				icons.forEach(icon => icon.style.opacity = 0.5);
			else
				icons.forEach(icon => icon.style.opacity = 1);
			buttonIcon.classList.toggle("selected")
		}
	})

	buttonIcon.addEventListener('mouseenter', () => {
		icons.forEach(icon => icon.style.opacity = 1);
	})

	buttonIcon.addEventListener('mouseleave', () => {
		if (!buttonIcon.classList.contains("selected"))
			icons.forEach(icon => icon.style.opacity = 0.5);
	})

}

const selectablesButtons = document.getElementsByClassName('selectable')

document.addEventListener('click', (event) => {
	for (const button of selectablesButtons) {
		if (!button.contains(event.target) && button.classList.contains("selected") && !button.classList.contains("like"))
		{
			button.classList.remove("selected")
			const icon = button.querySelector(".icon")
			if (icon)
				icon.style.opacity = 0.5
			break
		}
	}
})
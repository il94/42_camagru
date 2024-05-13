const buttonIcons = document.getElementsByClassName("button-icon")

for (const buttonIcon of buttonIcons) {

	const icon = buttonIcon.querySelector(".icon")

	buttonIcon.addEventListener('click', () => {

		if (buttonIcon.classList.contains("selectable"))
		{	
			if (buttonIcon.classList.contains("selected"))
				icon.style.opacity = 0.5
			buttonIcon.classList.toggle("selected")
		}
	})

	buttonIcon.addEventListener('mouseenter', () => {
		icon.style.opacity = 1
	})

	buttonIcon.addEventListener('mouseleave', () => {
		if (!buttonIcon.classList.contains("selected"))
			icon.style.opacity = 0.5
	})

}

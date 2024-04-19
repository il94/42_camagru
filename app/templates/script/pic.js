function getRandomColor() {
    const r = Math.floor(Math.random() * 156) + 100;
    const g = Math.floor(Math.random() * 156) + 100;
    const b = Math.floor(Math.random() * 156) + 100;

    const hexR = r.toString(16).padStart(2, '0');
    const hexG = g.toString(16).padStart(2, '0');
    const hexB = b.toString(16).padStart(2, '0');

    const hexColor = '#' + hexR + hexG + hexB + '80';

    return hexColor;
}

const pics = document.querySelectorAll(".pic")

for (const pic of pics) {

	// Applique une couleur random a la pic
	pic.style.backgroundColor = getRandomColor();
	
	// Ajoute l'image a la pic
	/* ============================ TEMPORAIRE ===============================*/

	const bodyRecto = pic.querySelector(".pic-body-recto");

	const images = [
		"/assets/pic_example_1.jpg",
		"/assets/pic_example_2.jpg",
		"/assets/pic_example_3.jpg",
		"/assets/pic_example_4.jpg"
	];

	const randomImage = Math.floor(Math.random() * images.length);
	bodyRecto.style.backgroundImage = `url(${images[randomImage]})`;

	/* =======================================================================*/

	// Effet de flip
	const moreButtons = pic.querySelectorAll(".more")
	moreButtons.forEach((moreButton) => moreButton.addEventListener('click', () => {
		pic.classList.toggle('flip');
	}))

	// Deplacments du placeholder
	const inputText = pic.querySelector(".pic-input-text");
	const placeHolder = pic.querySelector(".placeholder");

	// Reduit le placeholder au clic sur la zone de texte
	inputText.addEventListener('focus', () => {
		if (!placeHolder.classList.contains(".reduce"))
			placeHolder.classList.add("reduce");
	})
	
	// Si la zone de texte est vide, recentre le placeholder
	inputText.addEventListener('blur', (event) => {
		if (!event.target.value)
			placeHolder.classList.remove("reduce");
	})

	// Gere la taille de la zone de texte, en l'agrandissant et en reduisant les commentaires
	const bodyVerso = pic.querySelector(".pic-body-verso")
	const footerVerso = pic.querySelector(".pic-footer-verso")
	const input = pic.querySelector(".pic-input");

	const charHeight = 22 // Height d'une ligne de caracteres d'une font size de 18px
	const headerHeight = 52 // Height du header

	inputText.addEventListener('keydown', (event) => {
		if (event.key === "Backspace" && event.target.value) {
			console.log("HERE")
			inputText.style.height = inputText.scrollHeight - charHeight + 'px'
			input.style.height = inputText.scrollHeight + 'px'
			
			const footerNewSize = inputText.scrollHeight + charHeight
			footerVerso.style.height = footerNewSize + 'px'
			bodyVerso.style.height = `calc(100% - ${footerNewSize + headerHeight + 'px'})`
		}
	});
	inputText.addEventListener('input', () => {

		// Si le texte va depasser de la zone et que la zone est inferieure a la moitie de la pic
		if (inputText.clientHeight !== inputText.scrollHeight &&
			input.clientHeight < pic.clientHeight / 2)
		{
			inputText.style.height = inputText.scrollHeight + 'px'
			input.style.height = inputText.scrollHeight + charHeight + 'px'
			
			const footerNewSize = inputText.scrollHeight + charHeight * 2
			footerVerso.style.height = footerNewSize + 'px'
			bodyVerso.style.height = `calc(100% - ${footerNewSize + headerHeight + 'px'})`
		}
	});
}

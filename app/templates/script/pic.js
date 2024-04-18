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

	pic.style.backgroundColor = getRandomColor();
	
	const bodyRecto = pic.querySelector(".pic-body-recto");

	/* ============================ TEMPORAIRE ===============================*/

	const images = [
		"/assets/pic_example_1.jpg",
		"/assets/pic_example_2.jpg",
		"/assets/pic_example_3.jpg",
		"/assets/pic_example_4.jpg"
	];

	const randomImage = Math.floor(Math.random() * images.length);
	bodyRecto.style.backgroundImage = `url(${images[randomImage]})`;

	/* =======================================================================*/
	pic.addEventListener('click', () => {
		pic.classList.toggle('flip');
	})

	const input = pic.querySelector(".pic-input-text");
	const placeHolder = pic.querySelector(".placeholder");

	input.addEventListener('focus', () => {
		if (!placeHolder.classList.contains(".reduce"))
			placeHolder.classList.add("reduce");
	})
	input.addEventListener('blur', (event) => {
		if (!event.target.value)
			placeHolder.classList.remove("reduce");
	})
}

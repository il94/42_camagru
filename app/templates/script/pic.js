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

	const randomColor = getRandomColor();
	
	const headerPic = pic.querySelector(".pic-header");
	const imagePic = pic.querySelector(".pic-image");
	const footerPic = pic.querySelector(".pic-footer");
	
	headerPic.style.backgroundColor = randomColor;
	footerPic.style.backgroundColor = randomColor;

	/* ============================ TEMPORAIRE ===============================*/

	const images = [
		"/assets/pic_example_1.jpg",
		"/assets/pic_example_2.jpg",
		"/assets/pic_example_3.jpg",
		"/assets/pic_example_4.jpg"
	];

	const randomImage = Math.floor(Math.random() * images.length);
	imagePic.style.backgroundImage = `url(${images[randomImage]})`;

	/* =======================================================================*/

}

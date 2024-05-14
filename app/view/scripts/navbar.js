const logo = document.getElementById("desktop-navbar-logo")

function getGradient() {

	function getColor() {
		return Math.floor(Math.random() * 256);
	}
	function getBlue(red, green) {
	
		const min = Math.min(red, green)
		const max = Math.max(red, green)

		return min + Math.floor(Math.random() * ((max - min) / 2));
	}

	const redBase1 = getColor()
	const greenBase1 = getColor()

	const red1 = getColor()
	const green1 = getColor()
	const blue1 = getBlue(redBase1, greenBase1)

	const redBase2 = getColor()
	const greenBase2 = getColor()

	const red2 = getColor()
	const green2 = getColor()
	const blue2 = getBlue(redBase2, greenBase2)

	const color1 = 'rgb(' + red1 + ',' + green1 + ',' + blue1 + ')';
	const color2 = 'rgb(' + red2 + ',' + green2 + ',' + blue2 + ')';

	return ('linear-gradient(to right, ' + color1 + ', ' + color2 + ', ' + color1 + ', ' + color2 + ', ' + color1 + ', ' + color2 + ', ' + color1 + ')')	
}

logo.style.background = getGradient();
logo.style.webkitBackgroundClip = 'text';
logo.style.backgroundClip = 'text';
logo.style.color = 'transparent';

logo.style.backgroundSize = "300%"
logo.style.backgroundPosition = "-200%"

logo.style.animation = "scroll-color-word-gradient 40s linear infinite"

const logo = document.getElementById("dektop-header-logo")

function getGradient() {

	function getColor() {
		return Math.floor(Math.random() * 256);
	}
	function getBlue() {
	
		const min = Math.min(redBase, greenBase)
		const max = Math.max(redBase, greenBase)

		return min + Math.floor(Math.random() * ((max - min) / 2));
	}

	const redBase = getColor()
	const greenBase = getColor()

	const color1 = 'rgb(' + getColor() + ',' + getColor() + ',' + getBlue() + ')';
	const color2 = 'rgb(' + getColor() + ',' + getColor() + ',' + getBlue() + ')';

	return ('linear-gradient(to right, ' + color1 + ', ' + color2 + ')')	
}

logo.style.background = getGradient();
logo.style.webkitBackgroundClip = 'text';
logo.style.backgroundClip = 'text';
logo.style.color = 'transparent';
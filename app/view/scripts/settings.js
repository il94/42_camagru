const returnHomeButton = document.getElementById("return-home");

returnHomeButton.addEventListener('click', () => {
	window.location.href = "index.php?page=home";
})
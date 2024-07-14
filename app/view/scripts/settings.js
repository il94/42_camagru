const returnHomeButton = document.getElementById("return-home");

returnHomeButton?.addEventListener('click', () => {
	window.location.href = "index.php?page=home";
})

const returnSettingsButton = document.getElementById("return-settings");

returnSettingsButton?.addEventListener('click', () => {
	window.location.href = "index.php?page=settings";
})

const sections = document.getElementsByClassName("window-section");

for (const section of sections) {
	section.addEventListener('click', () => {
		window.location.href = `index.php?page=settings&state=${section.id.split('-')[0]}`;
	})
}

const windows = document.getElementsByClassName("window")

const loginTitles = [
	"Welcome back, Master.",
	"It's good to see you again, Your Grace.",
	"It's an honor, Your Excellency.",
	"WOOHOOOOOOOOOO"
]

const signupTitles = [
	"It's an honor, Your Excellency.",
	"It's good to see you, Guru.",
	"Welcome, Your Highness.",
	"WOOHOOOOOOOOOO",
	"Your presence here is an honor.",
	"Welcome among us, Boss."
]

function getRandomTitle(titles) {
    return titles[Math.floor(Math.random() * titles.length)];
}

for (const window of windows) {
	const title = window.querySelector(".window-title");
	if (title.classList.contains("random")) {
		if (window.id === "form-signup" || window.id === "window-activation" || window.id === "window-activate")
			title.innerHTML = getRandomTitle(signupTitles)
		else
			title.innerHTML = getRandomTitle(loginTitles)
	}
}
const feed = document.getElementById("feed")
const feedHeader = document.getElementById("feed-header")

let feedLastScrollValue = 0
if (feed.clientWidth < 480) {
	feedHeader.style.top = "0px"
	feedHeader.classList.add(".mobile")
}
else {
	feedHeader.style.top = "65px"
}

// Cache ou dévoile le header
feed.addEventListener('scroll', () => {

	// Si le scroll est vers le bas et que le scroll est a + de 10px
	if (feedLastScrollValue < feed.scrollTop && feed.scrollTop > 10) {
		feedHeader.style.top = "-100px"
	}
	// Sinon si le scroll est vers le haut
	else if (feedLastScrollValue >= feed.scrollTop) {
		if (feed.clientWidth <= 480)
			feedHeader.style.top = "0px"
		else
			feedHeader.style.top = "65px"
	}

	feedLastScrollValue = feed.scrollTop
})

window.addEventListener('resize', () => {

	if (feed.clientWidth <= 480) {
		feedHeader.classList.add(".mobile")
		feedHeader.style.top = "0px"
	}
	else {
		feedHeader.classList.remove(".mobile")
		if (feedHeader.style.top = "0px")
			feedHeader.style.top = "65px"
	}
})
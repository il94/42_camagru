import { initPic } from "./pic.js";

const feed = document.getElementById("feed")
const feedHeader = document.getElementById("feed-header")

let feedLastScrollValue = 0
feedHeader.style.top = "65px"

// Cache ou dévoile le header du feed
feed.addEventListener('scroll', () => {

	// Si le scroll est vers le bas, le header est visible et que le scroll est a + de 10px
	if (feedLastScrollValue < feed.scrollTop && feedHeader.style.top === "65px" && feed.scrollTop > 10) {
		feedHeader.style.top = "0px"
	}
	// Sinon si le scroll est vers le haut et le header est caché
	else if (feedLastScrollValue > feed.scrollTop && feedHeader.style.top === "0px") {
		feedHeader.style.top = "65px"
	}

	feedLastScrollValue = feed.scrollTop
})

const pics = document.querySelectorAll(".pic")
pics.forEach((pic) => initPic(pic))

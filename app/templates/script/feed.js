import { initPic } from "./pic.js";

const feed = document.getElementById("feed")
const feedHeader = document.getElementById("feed-header")

let feedLastScrollValue = 0
feedHeader.style.top = "65px"
feed.addEventListener('scroll', (event) => {

	if (feedLastScrollValue < feed.scrollTop && feedHeader.style.top === "65px") {
		feedHeader.style.top = "0px"
	}
	else if (feedLastScrollValue > feed.scrollTop && feedHeader.style.top === "0px") {
		feedHeader.style.top = "65px"
	}

	feedLastScrollValue = feed.scrollTop
})

const pics = document.querySelectorAll(".pic")
pics.forEach((pic) => initPic(pic))

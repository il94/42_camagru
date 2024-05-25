function getRandomColor() {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);

    const color = `rgba(${r}, ${g}, ${b}, 0.5)`

    return (color);
}

function generateComment(username, avatar, content) {
	return (
		`<div class="comment">
			<img src=${avatar}>
			<div class="comment-text">
				<p class="comment-text-username">${username}</p>
				<p class="comment-text-content">${content}</p>
			</div>
		</div>`
	)
}

// Soumet une requete au serveur pour poster le contenu de l'input text
function postComment(pic, inputText) {
	const xhr = new XMLHttpRequest();
	xhr.open('POST', `index.php?action=home&route=comment&picId=${pic.id}`, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	xhr.onreadystatechange = () => {
		if (xhr.readyState === 4) {
			if (xhr.status === 201) {
				const newComment = generateComment("broot", "osef", inputText.value);
				const comments = pic.querySelector('.pic-comments');

				comments.insertAdjacentHTML('afterbegin', newComment);
				inputText.value = ''
			}
			else {
				console.error("ERROR");
			}
		}
	}
	xhr.send("comment=" + encodeURIComponent(inputText.value));
}

const pics = document.getElementsByClassName("pic")

for (const pic of pics) {

	// Applique une couleur random a la pic
	pic.style.backgroundColor = getRandomColor();

	// Effet de flip
	const moreButtons = pic.querySelectorAll(".more")
	moreButtons.forEach((moreButton) => moreButton.addEventListener('click', () => {
		pic.classList.toggle('flip');
	}))

	// Post de commentaires
	const inputText = pic.querySelector(".pic-input-text");

	const arrowUpButton = pic.querySelector('.arrow-up-button');
	arrowUpButton.addEventListener('click', () => {
		const inputText = input.querySelector(".pic-input-text");
		postComment(pic, inputText);
	})

	inputText.addEventListener('keydown', (event) => {
		if (event.key === 'Enter') {
			event.preventDefault();
			postComment(pic, event.target);
		}
	})


	// Deplacments du placeholder
	const placeHolder = pic.querySelector(".placeholder");

	// Reduit le placeholder au clic sur la zone de texte
	inputText.addEventListener('focus', () => {
		if (!placeHolder.classList.contains(".reduce"))
			placeHolder.classList.add("reduce");
	})
	
	// Si la zone de texte est vide, recentre le placeholder
	inputText.addEventListener('blur', (event) => {
		if (!event.target.value)
			placeHolder.classList.remove("reduce");
	})


	// Gere la taille de la zone de texte, en l'agrandissant et en reduisant les commentaires
	const bodyVerso = pic.querySelector(".pic-body-verso")
	const footerVerso = pic.querySelector(".pic-footer-verso")
	const input = pic.querySelector(".pic-input");

	const charHeight = 22 // Height d'une ligne de caracteres d'une font size de 18px
	const headerHeight = 52 // Height du header

	inputText.addEventListener('keydown', (event) => {
		if (event.key === "Backspace" && event.target.value) {
			inputText.style.height = inputText.scrollHeight - charHeight + 'px'
			input.style.height = inputText.scrollHeight + 'px'
			
			const footerNewSize = inputText.scrollHeight + charHeight
			footerVerso.style.height = footerNewSize + 'px'
			bodyVerso.style.height = `calc(100% - ${footerNewSize + headerHeight + 'px'})`
		}
	});
	inputText.addEventListener('input', () => {
		// Si le texte va depasser de la zone et que la zone est inferieure a la moitie de la pic
		if (inputText.clientHeight !== inputText.scrollHeight &&
			input.clientHeight < pic.clientHeight / 2)
		{
			inputText.style.height = inputText.scrollHeight + 'px'
			input.style.height = inputText.scrollHeight + charHeight + 'px'
			
			const footerNewSize = inputText.scrollHeight + charHeight * 2
			footerVerso.style.height = footerNewSize + 'px'
			bodyVerso.style.height = `calc(100% - ${footerNewSize + headerHeight + 'px'})`
		}
	})
}
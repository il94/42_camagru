export function displayComment(commentData) {
	const comment = document.createElement("div")
	comment.className = "comment"
	comment.id = commentData.id

	comment.innerHTML = `
		<img src=${commentData.user.avatar}>
		<div class="comment-text">
			<p class="comment-text-username">${commentData.user.username}</p>
			<p class="comment-text-content">${commentData.content}</p>
		</div>
	`

	return comment
}

export function createComment(commentData) {
	const comment = document.createElement("div");
	comment.className = "comment";
	comment.id = commentData.id;

	const img = document.createElement("img");
	img.src = encodeURI(commentData.user.avatar);
	img.alt = `${commentData.user.username}'s avatar`;

	const textDiv = document.createElement("div");
	textDiv.className = "comment-text";

	const usernameP = document.createElement("p");
	usernameP.className = "comment-text-username";
	usernameP.textContent = commentData.user.username;

	const contentP = document.createElement("p");
	contentP.className = "comment-text-content";
	contentP.textContent = commentData.content;

	textDiv.appendChild(usernameP);
	textDiv.appendChild(contentP);

	comment.appendChild(img);
	comment.appendChild(textDiv);

	return comment;
}
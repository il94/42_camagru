export function createComment(commentData) {
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
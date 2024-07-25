const form = document.getElementById("form")

form.addEventListener('click', () => {
	const fileInput = form.querySelector(`#file-input`);

	// fileInput.addEventListener('change', (event) => {
	// 	const file = event.target.files[0];

	// 	if (file) {
	// 		const reader = new FileReader();
	// 		reader.onload = function(e) {
	// 			avatarField.src = e.target.result;
	// 		};
	// 		reader.readAsDataURL(file);
	// 	}
	// });

	const file = fileInput.files[0];

	if (!file) {
		// formErrorMessage.textContent = 'Please select a file.';
		return;
	}

	const xhr = new XMLHttpRequest();
	xhr.open('POST', `index.php?page=create`, true);
	xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

	xhr.onreadystatechange = () => {
		if (xhr.readyState === 4) {
			if (xhr.status === 201) {
				console.log("OK")

				// window.location.href = `index.php?page=settings&state=updated&data=avatar`;
			}
			else {
				console.log("ERROR")
				// const response = JSON.parse(xhr.responseText);

				// formErrorMessage.textContent = response.message
			}
		}
	};

	const formData = new FormData();
	formData.append('pic', file);
	xhr.send(formData);
})

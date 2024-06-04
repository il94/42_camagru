const form = document.getElementsByClassName("form")[0];

// Inputs du formlaire
const inputs = form.querySelectorAll(".input");

// Message d'erreur du formulaire
const formErrorMessage = form.querySelector(".form-error-message");

// Retire l'indication d'erreur apres une nouvelle entree
for (const input of inputs) {
	input.addEventListener('keydown', () => {
		input.classList.remove("input-error");
		formErrorMessage.textContent = '';
	})
}

// Soumission du formulaire
form.addEventListener('submit', (event) => {
	event.preventDefault();

	// Formulaire de connexion
	if (form.id === "form-login") {

		// Valeurs des inputs
		const loginValue = form.querySelector("#login-value").value;
		const passwordValue = form.querySelector("#password-value").value;

		const xhr = new XMLHttpRequest();
		xhr.open('POST', `index.php?page=auth&route=login`, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	
		xhr.onreadystatechange = () => {
			if (xhr.readyState === 4) {
				if (xhr.status === 201) {
					window.location.href = "index.php?page=home";
				}
				else {
					const response = JSON.parse(xhr.responseText);

					if (response.field === "LOGIN") {
						inputs[0].classList.add("input-error");
					}
					else if (response.field === "PASSWORD") {
						inputs[1].classList.add("input-error");
					}

					formErrorMessage.textContent = response.message;
				}
			}
		}

		const postData = `login=${encodeURIComponent(loginValue)}&password=${encodeURIComponent(passwordValue)}`;
		xhr.send(postData);
	}

	// Formulaire d'inscription
	else if (form.id === "form-signup") {

		// Valeurs des inputs
		const emailValue = form.querySelector("#email-value").value;
		const usernameValue = form.querySelector("#username-value").value;
		const passwordValue = form.querySelector("#password-value").value;
		const retypePasswordValue = form.querySelector("#re-type-password-value").value;

		const xhr = new XMLHttpRequest();
		xhr.open('POST', `index.php?page=auth&route=signup`, true);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	
		xhr.onreadystatechange = () => {
			if (xhr.readyState === 4) {
				if (xhr.status === 201) {
					window.location.href = "index.php?page=home";
				}
				else {
					const response = JSON.parse(xhr.responseText);

					if (response.field === "EMAIL") {
						inputs[0].classList.add("input-error");
					}
					else if (response.field === "USERNAME") {
						inputs[1].classList.add("input-error");
					}
					else if (response.field === "PASSWORD") {
						inputs[2].classList.add("input-error");
					}
					else if (response.field === "RETYPE_PASSWORD") {
						inputs[3].classList.add("input-error");
					}

					formErrorMessage.textContent = response.message;
				}
			}
		}

		const postData = `email=${encodeURIComponent(emailValue)}&username=${encodeURIComponent(usernameValue)}&password=${encodeURIComponent(passwordValue)}&retypepassword=${encodeURIComponent(retypePasswordValue)}`;
		xhr.send(postData);
	}
})
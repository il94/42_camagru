const returnHomeButton = document.getElementById("return-home");

returnHomeButton?.addEventListener('click', () => {
	window.location.href = "/";
})

// Permet aux boutons "login" de rediriger vers la page de connexion
const returnSettingsButtons = document.getElementsByClassName("settings-redirection-button");

for (const button of returnSettingsButtons) {
	button.addEventListener('click', () => {
		window.location.href = "/settings";
	});
}

// Permet aux boutons "login" de rediriger vers la page de connexion
const loginRedirectionButtons = document.getElementsByClassName("login-redirection-button");

for (const button of loginRedirectionButtons) {
	button.addEventListener('click', () => {
		window.location.href = "/login";
	});
}

const logoutButton = document.getElementById("logout-button");

logoutButton?.addEventListener('click', () => {
	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

	const xhr = new XMLHttpRequest();
	xhr.open('POST', `/logout`, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.setRequestHeader('X-CSRF-Token', csrfToken);

	xhr.onreadystatechange = () => {
		if (xhr.readyState === 4) {
			if (xhr.status === 201) {
				window.location.href = "/login";
			}
			else {
				console.error("ERROR", xhr.responseText);
			}
		}
	}

	xhr.send();
})

const sections = document.getElementsByClassName("window-section");

for (const section of sections) {
	if (section.id.split('-')[0] !== "logout") {
		section.addEventListener('click', () => {
			window.location.href = `/settings/${section.id.split('-')[0]}`;
		})
	}
}

const form = document.getElementsByClassName("window-form")[0];

if (form) {

	// Inputs du formlaire
	const inputs = form.querySelectorAll(".window-input");

	// Message d'erreur du formulaire
	const formErrorMessage = form.querySelector(".window-error-message");

	// Retire l'indication d'erreur apres une nouvelle entree
	for (const input of inputs) {
		input.addEventListener('keydown', () => {
			input.classList.remove("window-input-error");
			formErrorMessage.textContent = '';
		})
	}

	switch (form.id) {
		case "form-username" :
		case "form-email" : {
			form.addEventListener('submit', (event) => {
				event.preventDefault();

				// Valeurs de l'input
				const value = form.querySelector(`#${form.name}-value`).value;
				const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			
				const xhr = new XMLHttpRequest();
				xhr.open('POST', `/settings/update`, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xhr.setRequestHeader('X-CSRF-Token', csrfToken);

				xhr.onreadystatechange = () => {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							if (form.name === "username")
								window.location.href = `/settings/updated?data=${form.name}`;
							else
								window.location.href = `/settings/update_start?email=${encodeURIComponent(value)}`;
						}
						else {
							const response = JSON.parse(xhr.responseText);
							if (response.field === "USERNAME" || response.field === "EMAIL") {
								inputs[0].classList.add("window-input-error");
							}
	
							formErrorMessage.textContent = response.message;
						}
					}
				}
	
				const postData = `${form.name}=${encodeURIComponent(value)}`;
				xhr.send(postData);	
			})

			break ;
		}

		case "form-password" : {
			form.addEventListener('submit', (event) => {
				event.preventDefault();

				// Valeurs des inputs
				const currentPasswordValue = form.querySelector("#current-password-value").value;
				const newPasswordValue = form.querySelector("#new-password-value").value;
				const retypeNewPasswordValue = form.querySelector("#re-type-new-password-value").value;

				const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			
				const xhr = new XMLHttpRequest();
				xhr.open('POST', `/settings/update`, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xhr.setRequestHeader('X-CSRF-Token', csrfToken);
			
				xhr.onreadystatechange = () => {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							window.location.href = `/login`;
						}
						else {
							const response = JSON.parse(xhr.responseText);

							if (response.field === "PASSWORD") {
								inputs[0].classList.add("window-input-error");
							}
							else if (response.field === "NEW_PASSWORD") {
								inputs[1].classList.add("window-input-error");
							}
							else if (response.field === "RETYPE_PASSWORD") {
								inputs[2].classList.add("window-input-error");
							}

							formErrorMessage.textContent = response.message;
						}
					}
				}

				const postData = `currentpassword=${encodeURIComponent(currentPasswordValue)}&newpassword=${encodeURIComponent(newPasswordValue)}&retypenewpassword=${encodeURIComponent(retypeNewPasswordValue)}`;
				xhr.send(postData);
			})

			break ;
		}

		case "form-avatar" : {
			const fileInput = form.querySelector(`#input-file`);
			const avatarField = document.getElementById('avatar-field');

			fileInput.addEventListener('change', (event) => {
				const file = event.target.files[0];

				if (file) {
					const reader = new FileReader();
					reader.onload = function(e) {
						avatarField.src = e.target.result;
					};
					reader.readAsDataURL(file);
				}
			});

			form.addEventListener('submit', (event) => {
				event.preventDefault();

				const file = fileInput.files[0];

				if (!file) {
					formErrorMessage.textContent = 'Please select a file.';
					return;
				}

				const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			
				const xhr = new XMLHttpRequest();
				xhr.open('POST', `/settings/update`, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xhr.setRequestHeader('X-CSRF-Token', csrfToken);

				xhr.onreadystatechange = () => {
					if (xhr.readyState === 4) {
						if (xhr.status === 200) {
							window.location.href = `/settings/updated?data=avatar`;
						}
						else {
							const response = JSON.parse(xhr.responseText);

							formErrorMessage.textContent = response.message
						}
					}
				};

				const formData = new FormData();
				formData.append('avatar', file);
				xhr.send(formData);
			})

			break ;
		}

		case "form-notifications" : {
			function sendRequest(paramName, paramValue) {
				const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			
				const xhr = new XMLHttpRequest();
				xhr.open('POST', `/settings/update`, true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xhr.setRequestHeader('X-CSRF-Token', csrfToken);
				
				xhr.send(`${paramName}=${paramValue}`);
			}
			
			const notificationLikeInput = document.getElementById('notification-like-input');
			const notificationLikeComment = document.getElementById('notification-like-comment');

			notificationLikeInput.addEventListener('change', () => {
				sendRequest('notification_like', notificationLikeInput.checked ? 1 : 0);

			});

			notificationLikeComment.addEventListener('change', () => {
				sendRequest('notification_comment', notificationLikeComment.checked ? 1 : 0);
			});

			break ;
		}
	}
}

const sendPasswordReinitialization =  document.getElementById('send-password-reinitialization');
sendPasswordReinitialization?.addEventListener('click', () => {

	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			
	const xhr = new XMLHttpRequest();
	xhr.open('POST', `/settings/forgot-password`, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.setRequestHeader('X-CSRF-Token', csrfToken);

	xhr.onreadystatechange = () => {
		if (xhr.readyState === 4) {
			if (xhr.status === 201) {
				const response = JSON.parse(xhr.responseText);
				window.location.href = `/settings/reinitialization-start?email=${encodeURIComponent(response)}`;
			}
			else {
				console.error('ERROR')
			}
		}
	}

	const postData = ``;
	xhr.send(postData);
})
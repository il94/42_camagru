/* DEMO DIALOG */

// Affichee a la premiere arrivee dans l'app avec le compte de demonstration.
// Le choix est memorise pour l'onglet (sessionStorage) : la dialog ne revient
// pas au rechargement, mais revient dans une nouvelle session.

const DEMO_DIALOG_STORAGE_KEY = "craftypic-demo-dialog-seen";

const overlay = document.getElementById("demo-dialog-overlay");

if (overlay && !sessionStorage.getItem(DEMO_DIALOG_STORAGE_KEY))
	overlay.style.display = "flex";

function closeDialog() {
	sessionStorage.setItem(DEMO_DIALOG_STORAGE_KEY, "true");
	overlay.style.display = "none";
}

const closeButton = document.getElementById("demo-dialog-close");
closeButton?.addEventListener('click', closeDialog);

// Clic en dehors de la dialog
overlay?.addEventListener('click', (event) => {
	if (event.target === overlay)
		closeDialog();
})

// La page d'inscription est interdite tant qu'une session est ouverte : il faut
// deconnecter le compte de demonstration avant d'y rediriger
const signupLink = document.getElementById("demo-dialog-signup");
signupLink?.addEventListener('click', (event) => {
	event.preventDefault();

	const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

	const xhr = new XMLHttpRequest();
	xhr.open('POST', `/logout`, true);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.setRequestHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
	xhr.setRequestHeader('Pragma', 'no-cache');
	xhr.setRequestHeader('X-CSRF-Token', csrfToken);

	xhr.onreadystatechange = () => {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				sessionStorage.removeItem(DEMO_DIALOG_STORAGE_KEY);
				window.location.href = "/signup";
			}
			else {
				const response = JSON.parse(xhr.responseText);
				console.error(response.message);
			}
		}
	}

	xhr.send();
})

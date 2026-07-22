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

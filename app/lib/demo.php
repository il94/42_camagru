<?php

/**
 * Mode démonstration.
 *
 * Un compte partagé, dont les identifiants sont affichés publiquement par le
 * badge (cf. view/assets/demo_badge.php), permet à un visiteur d'entrer dans
 * l'app sans inscription ni activation par email.
 *
 * Le compte est créé par `php /var/www/html/seed.demo.php` et reconnu par son
 * seul username (DEMO_USERNAME). Si la variable est absente, tout le mode démo
 * est inactif : ni badge, ni dialog, ni restriction.
 *
 * Le compte est bridé ici, côté serveur (cf. demoGuard) : les masquages faits
 * dans les vues et les scripts ne sont que du confort.
 */

// Le mode démo n'existe que si un compte est désigné
function demoEnabled() {
	return demoUsername() !== '';
}

// Username du compte de démonstration
function demoUsername() {
	return $_ENV['DEMO_USERNAME'] ?? '';
}

// Email du compte de démonstration
function demoEmail() {
	return $_ENV['DEMO_EMAIL'] ?? '';
}

// Mot de passe du compte de démonstration, affiché par le badge.
// L'authentification, elle, passe par le hash stocké en base.
function demoPassword() {
	return $_ENV['DEMO_PASSWORD'] ?? '';
}

// Verifie si la saisie du formulaire de connexion vise le compte de démonstration.
// Utilisé avant l'authentification : la vérité reste le username retourné par la base.
function isDemoLogin($login) {
	if (!demoEnabled() || empty($login))
		return false;
	return $login === demoUsername() || (demoEmail() !== '' && $login === demoEmail());
}

// Verifie si la session en cours est celle du compte de démonstration.
// Le flag est posé a la connexion (cf. AuthService::login), ce qui evite
// une requete en base a chaque requete HTTP.
function isDemoSession() {
	return !empty($_SESSION['demo']);
}

// Refuse une action au compte de démonstration.
// Repond du JSON, et non un 403 vide comme forbidden(), parce que les scripts
// du front lisent `message` et `field` sur les reponses en erreur.
function demoForbidden() {
	http_response_code(403);

	$response = new stdClass();
	$response->message = "The demo account is shared : this action is disabled. Create your own account to unlock it !";
	$response->field = "";

	echo json_encode($response);
	exit();
}

// Bride le compte de démonstration.
// Autorise la lecture (GET), le like et la deconnexion, refuse tout le reste :
// publication de pic, commentaire, suppression de pic et settings.
function demoGuard($page, $route, $method) {

	if (!isDemoSession())
		return;

	if ($method === 'GET')
		return;

	if ($method === 'POST' && $page === 'auth' && $route === 'logout')
		return;

	if ($method === 'POST' && $page === 'home' && $route === 'like')
		return;

	demoForbidden();
}

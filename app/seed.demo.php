<?php

/**
 * Script de creation du compte de demonstration (hors HTTP).
 *
 * Le compte est celui designe par DEMO_USERNAME / DEMO_EMAIL, avec le mot de
 * passe DEMO_PASSWORD (cf. .env). Il permet a un visiteur d'entrer dans l'app
 * sans inscription et sans activation par email, via le badge affiche sur les
 * pages publiques.
 *
 * Le compte est cree active (`active` = 1) : sans ca, la connexion repondrait
 * "You have to activate your account", l'email de demonstration etant fictif.
 * Pour la meme raison, ses notifications email sont coupees.
 *
 * Il n'y a rien d'autre a semer : la galerie est alimentee par la communaute,
 * le feed du compte n'est donc jamais vide.
 *
 * Le compte est bride cote serveur (cf. lib/demo.php) : il peut lire, liker et
 * utiliser l'editeur, mais ne peut ni publier, ni commenter, ni toucher a ses
 * settings. Aucun etat ne s'accumule dessus, il n'y a rien a reinitialiser.
 *
 * Le script est idempotent (ON DUPLICATE KEY UPDATE sur le username et l'email,
 * uniques) : le rejouer remet le mot de passe et les flags dans l'etat attendu.
 *
 * Usage : `docker compose exec php php /var/www/html/seed.demo.php`
 * (ou `php /var/www/html/seed.demo.php` depuis le terminal du conteneur ;
 * le host `mysql` de MYSQL_DSN ne se resout que dans le reseau Docker)
 *
 * Le script n'est pas joignable par le web : nginx refuse tout .php autre
 * qu'index.php (cf. nginx.conf).
 */

if (PHP_SAPI !== 'cli') {
	http_response_code(403);
	exit(1);
}

chdir(__DIR__);

require_once('config.php');
require_once('lib/demo.php');
require_once('lib/utils.php');

if (!demoEnabled() || demoPassword() === '') {
	fwrite(STDERR, "DEMO_USERNAME et DEMO_PASSWORD doivent etre definis (cf. .env)\n");
	exit(1);
}

$username = demoUsername();
$email = demoEmail() !== '' ? demoEmail() : $username . '@demo.com';
$password = password_hash(demoPassword(), PASSWORD_DEFAULT);

$client = connectDB();

$query = $client->prepare(
	"INSERT INTO `user` (
		`username`, `email`, `password`, `avatar`, `role`,
		`notification_like`, `notification_comment`,
		`activation_token`, `activation_token_expires_at`, `active`,
		`reset_password_token`, `reset_password_token_expires_at`,
		`update_email_token`, `update_email_token_expires_at`
	)
	VALUES (
		:username, :email, :password, :avatar, :role,
		FALSE, FALSE,
		NULL, NULL, TRUE,
		NULL, NULL,
		NULL, NULL
	)
	ON DUPLICATE KEY UPDATE
		`username` = VALUES(`username`),
		`email` = VALUES(`email`),
		`password` = VALUES(`password`),
		`avatar` = VALUES(`avatar`),
		`role` = VALUES(`role`),
		`notification_like` = FALSE,
		`notification_comment` = FALSE,
		`activation_token` = NULL,
		`activation_token_expires_at` = NULL,
		`active` = TRUE,
		`reset_password_token` = NULL,
		`reset_password_token_expires_at` = NULL,
		`update_email_token` = NULL,
		`update_email_token_expires_at` = NULL"
);

$query->execute([
	'username' => $username,
	'email' => $email,
	'password' => $password,
	'avatar' => DEFAULT_AVATAR,
	'role' => DEFAULT_ROLE,
]);

$user = $client->prepare("SELECT `id` FROM `user` WHERE `username` = :username");
$user->execute(['username' => $username]);
$userId = $user->fetch()['id'];

echo "Demo user ready (id " . $userId . ", username " . $username . ", email " . $email . ")\n";
echo "Read, like and editor allowed. Publishing, comments and settings blocked.\n";

exit(0);

<?php

define('DEFAULT_AVATAR', 'uploads/default_avatar.svg');
define('DEFAULT_ROLE', 'USER');

define('UPLOAD_RELATIVE_PATH', '/uploads/');
define('UPLOAD_ABSOLUTE_PATH', getcwd() . '/uploads/');
define('STICKERS_PATH', getcwd() . '/view/assets/');

define('PICSIZE', 400);

define('ALLOWED_MIMETYPES', ["image/png"]);
define('ALLOWED_EXTENSIONS', ["png"]);
define('MAX_FILE_SIZE', 2.5 * 1024 * 1024);
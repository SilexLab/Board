<?php
// Do we have a config?
define('CFG', 1);

// If in development set this to true
define('CFG_DEBUG', true);

// Database Config
define('CFG_DB_TYPE',     'MySQL');
define('CFG_DB_USER',     'root');
define('CFG_DB_PASSWORD', '');
define('CFG_DB_DATABASE', 'silexboard');
define('CFG_DB_PREFIX',   '');
define('CFG_DB_HOST',     '127.0.0.1');
define('CFG_DB_PORT',     '');
define('CFG_DB_SOCKET',   '');

define('CFG_CACHE_DIR',   DIR_ROOT.'cache/');

// URL info
define('CFG_BASE_URL', '/');

// Security
define('CFG_SALT', 'Mm2zTloKiuGqYIw/DgVtB');


/* --- Currently not needed stuff --- */

// Cache info
define('CFG_CACHE_TYPE',  'File');

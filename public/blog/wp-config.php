<?php
require_once(dirname(__FILE__) . '/../procs/common.php');
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
define('DB_NAME',     $sqlDatabaseConnectionInfo['db']);
define('DB_USER',     $sqlDatabaseConnectionInfo['user']);
define('DB_PASSWORD', $sqlDatabaseConnectionInfo['password']);
define('DB_HOST',     $sqlDatabaseConnectionInfo['host']);
define('DB_CHARSET',  'utf8');
define('DB_COLLATE',  '');
define('WPDB_DRIVER', 'pdo_mysql');

/**#@+
 * WordPress does not suggest we hard-code the blog Home and SiteURL settings as this overrides what
 * is set in General Options, but for our case this makes more sense as the site host is determined
 * by our stage configuration and cannot be hardcoded.
 */
define('WP_HOME',     $webServer . '/blog/');
define('WP_SITEURL',  $webServer . '/blog/');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'MakingGamesIsFun');
define('SECURE_AUTH_KEY',  'MakingGamesIsZZZ');
define('LOGGED_IN_KEY',    'MakingGamesIsZen');
define('NONCE_KEY',        'MakingGamesIsHot');
define('AUTH_SALT',        'MakingGamesIsHappy');
define('SECURE_AUTH_SALT', 'MakingGamesIsJoy');
define('LOGGED_IN_SALT',   'MakingGamesIsHard');
define('NONCE_SALT',       'MakingGamesIsRad');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

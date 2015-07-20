<?php
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

function db_mask() {

	$local_ip_match = preg_match(
		'/^(192\.168\.|10\.|172\.(1[6-9]|2[0-9]|3[0-2])|127\.0\.0\.1)/',
		$_SERVER['REMOTE_ADDR']
	);

	$staging_domain = preg_match(
		'/changeme\.dev/',
		$_SERVER['HTTP_HOST']
	);

	if ($local_ip_match) {

		return json_decode(
			$local = '{
				"db_name": "replace_with_local_db",
				"db_user": "root",
				"db_pass": "root",
				"db_host": "localhost",
				"domain" : ".dev",
				"wp_home": ".dev"
			}'
		);

	} elseif ($staging_domain) {

		return json_decode(
			$staging = '{
				"db_name": "",
				"db_user": "",
				"db_pass": "",
				"db_host": "",
				"domain": ".com",
				"wp_home": ".com"
			}'
		);

	} else {

		return json_decode(
			$production = '{
				"db_name": "",
				"db_user": "",
				"db_pass": "",
				"db_host": "",
				"domain": ".com",
				"wp_home": ".com"
			}'
		);
	}
}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME',            db_mask()->db_name);

/** MySQL database username */
define('DB_USER',            db_mask()->db_user);

/** MySQL database password */
define('DB_PASSWORD',        db_mask()->db_pass);

/** MySQL hostname */
define('DB_HOST',            db_mask()->db_host);

/** Wordpress Site URL */
define('WP_SITEURL',         db_mask()->domain);

/** Wordpress Home URL */
define('WP_HOME',            db_mask()->wp_home);

/** Set mask to the default template for WordPress to use. */
define('WP_DEFAULT_THEME',  'mask');

/** Set reasonable number of post revisions to maintain per post. */
define( 'WP_POST_REVISIONS', 15 );

/** Database Charset to use in creating database tables. */
define('DB_CHARSET',        'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE',        '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
// Insert_Salts_Below

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

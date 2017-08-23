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

if ( file_exists( __DIR__ . DIRECTORY_SEPARATOR . 'wp-config-local.php' ) ) {
	define( 'WP_LOCAL_DEV', true );
	include( __DIR__ . DIRECTORY_SEPARATOR . 'wp-config-local.php' );
} else {
	define( 'WP_LOCAL_DEV', false );

	define( 'DB_HOST', ini_get( 'mysql.default_host' ) );
	define( 'DB_NAME', 'db' );
	define( 'DB_USER', 'user' );
	define( 'DB_PASSWORD', 'password' );

	define( 'AUTH_KEY',         'put your unique phrase here' );
	define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
	define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
	define( 'NONCE_KEY',        'put your unique phrase here' );
	define( 'AUTH_SALT',        'put your unique phrase here' );
	define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
	define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
	define( 'NONCE_SALT',       'put your unique phrase here' );

	define('WP_DEBUG', true);
	//define( 'SAVEQUERIES', true );
	
	if ( !defined('ABSPATH') )
		define( 'ABSPATH', __DIR__ . DIRECTORY_SEPARATOR . 'wordpress' . DIRECTORY_SEPARATOR );

	define( 'WP_CONTENT_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'wp-content' );

	define( 'WP_CONTENT_URL', 'http://st.test.www.csm.nov.ru/wp-content' );
	define( 'COOKIE_DOMAIN', 'test.www.csm.nov.ru' );

	define( 'WPCACHEHOME', WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'wp-super-cache' . DIRECTORY_SEPARATOR );
};

define('WP_CACHE', true); //Added by WP-Cache Manager

define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

$table_prefix  = 'wp_';

define ('WPLANG', 'ru_RU');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

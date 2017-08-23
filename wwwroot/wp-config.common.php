<?php
// Configuration common to all VersionPress environments, included from `wp-config.php`.
// Learn more at https://docs.versionpress.net/en/getting-started/configuration

if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', __DIR__ . DIRECTORY_SEPARATOR . 'wordpress' . DIRECTORY_SEPARATOR );

define( 'VP_PROJECT_ROOT', dirname( __DIR__ ) );

define( 'WP_CONTENT_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'wp-content' );

//define( 'WPCACHEHOME', WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'wp-super-cache' . DIRECTORY_SEPARATOR );

define( 'WP_CACHE', true);

define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

$table_prefix  = 'wp_';

define( 'WPLANG', 'ru_RU' );

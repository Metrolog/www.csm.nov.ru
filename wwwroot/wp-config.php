<?php

// Configuration common to all environments
include_once __DIR__ . '/wp-config.common.php';

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

define('DB_NAME', 'csmnovru');
define('DB_USER', 'csmnovru');
define('DB_PASSWORD', 'WCV53He');
define('DB_HOST', ini_get( 'mysqli.default_host' ));

define('AUTH_KEY',         'W rZrop$;*>pEK2kUt2uG;|P-cWZ54nY?,V-0ED2t&/jqJ-L4([F{jBP6EVetHVH');
define('SECURE_AUTH_KEY',  'yf6J^] a!fVw3p-:cIY}#s^-{HU^>`CxX!?a&7Dz|S7L pDnuu[^(dh(oCTax29U');
define('LOGGED_IN_KEY',    '@YGN4Bl/^CfNk4-WTl]11<yGqw[k((oB8SDS-L$#mG*,$sge*-/Sin#(l4>5Aea7');
define('NONCE_KEY',        'vjd!K6n9>mC^Y|4R6^sj~C:GC/?EQ>dH++wqkg+0:j _=RN]EN,PEpBOfGOHK`nd');
define('AUTH_SALT',        '4P`L|Ig$#^MH*sL2Yp%_oxG`+QNM)~Bx52@[Nv-9ClQoM.9c!ZQ69z_l1~+#-9Ql');
define('SECURE_AUTH_SALT', ')_BB.nS+ROyk#@T$U~jdi:[Sxes3, m0%Ji$bNm,D$,:(e }3vJj/mX|@1?9g{Xh');
define('LOGGED_IN_SALT',   ')`3sf1}ZIizn.1=o8r;BnFcZ,,XZMh&QE+qMDb0DB)X18d{G$~X2GIi-:?k*Ts2U');
define('NONCE_SALT',       'Lkbq0WTgW`Gbjw4fT+Wc]lpo snx#2V+WWhJ<e>/^t,Rr{>X}j#y@f^s}78xB!gq');

ini_set( 'display_errors', false );
define('WP_DEBUG', false);
//define( 'SAVEQUERIES', true );

define( 'WPCACHEHOME', 'L:\inetpub\git.www.csm.nov.ru\wwwroot\wp-content\plugins\wp-super-cache/' );
//define( 'WPCACHEHOME', WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'wp-super-cache' . DIRECTORY_SEPARATOR );

define('WP_CONTENT_URL', 'http://st.test.www.csm.nov.ru/wp-content');
define('COOKIE_DOMAIN', 'test.www.csm.nov.ru');


define('VP_GIT_BINARY', 'C:\Program Files\Git\bin\git.exe');

 
/** Sets up WordPress vars and included files. */
define('VP_ENVIRONMENT', 'dev');
require_once(ABSPATH . 'wp-settings.php');

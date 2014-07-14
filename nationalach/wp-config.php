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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'c1nationalach_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('WP_HOME','http://localhost/nationalach/');
define('WP_SITEURL','http://localhost/nationalach/');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '0bQZ*`d;E_:6,#~~],=fy/,M2bw;wyzS_QU~}$FjQ.ii%BxrVI=XelEch!i ($=r');
define('SECURE_AUTH_KEY',  '9;FD&F1ecdCF}(Xgag}W_y8Vv*.x{$|=PG>r.7>H}Iv`%)9m@+->A4H?*3A)NA,;');
define('LOGGED_IN_KEY',    'eBYY##`C=[xH}4gOc#s<U?cl{g1xp%l((:J1JJ^hCw.#Af,$]@o$o=Tx!=Z#*)=x');
define('NONCE_KEY',        '&g NTo#/`F-/ynQ#^(^n6|b9uc:x_T@WHUM=IBo27A? T0h<w 5*1&e`=p_k(P~X');
define('AUTH_SALT',        'E[~f!>F}PH_E>L(|6NdB:*PRKvh:pM-]4!up-6[64[E`@+^Mcl>;Pl70~u_ &qYm');
define('SECURE_AUTH_SALT', 'iQx^:nC|Sg@Wz@={h]4s/;G}JDQ6?]VG@C>/0%//_ALs5hSqZLxYYK,^4#JO,1<S');
define('LOGGED_IN_SALT',   '@O}=9)%WKIFw:hl)cQ,Yqg5<wv`iQ*hn4Dza:/G1Bem2$vxX?i#_&o?j6djaG)=$');
define('NONCE_SALT',       '#H-w.#_QMU9Kcg%@*R kA888(5DtIoQk1KF]0F]DlXC83Pl9?`BB!:G`X1#]&.a%');

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
define('FS_METHOD', 'direct');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');



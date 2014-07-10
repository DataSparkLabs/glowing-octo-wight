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
define('DB_NAME', 'c1paynet_wp');

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
define('WP_HOME','http://localhost/paynet');
define('WP_SITEURL','http://localhost/paynet');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'T/j!K(d6|,kbNhb+{qP4if]|Djp+t*mu4T36Rkk?Ss(#KJMqukd!K?^!-%T*+gP-');
define('SECURE_AUTH_KEY',  'w%e[.G% ,)2n>BZ3Y=G|=/^H{1;qj>!G32#ThTrE=VmdmqWd~keend7gdrL}Q6Jk');
define('LOGGED_IN_KEY',    '6PvX T2l{K&A!,>%ebYK9Dz+&$^#zSDid#nuZ61r6rTYrHto]CEI`mLv~FG6B`+G');
define('NONCE_KEY',        'nt/ieam?LlV4W{a;p1@:J-D|=c4EeS_yQmF}q[TT!Pb-n++$Dm])0{53D6Z8|=#s');
define('AUTH_SALT',        'oZ,h/P69No3 AjW]~eveYv&%.sO@*gkh-7B^ahHS[xSvTXKt|UoJ)*7n-2b,QTX)');
define('SECURE_AUTH_SALT', 'W7DHcZf<s<n[u@Z{&#^hxQ}Bh-97c<wJ,Lmi4-EF9?mkz<+00|e?QQ:JYD}QE1},');
define('LOGGED_IN_SALT',   'P.|tEhwm63WkV>4-Vvz:ZQknjQ<e!ZDBX2?i@J+8+l6-cQ2ZwdZ(,-*K%+%inApI');
define('NONCE_SALT',       '9z5nTD-,L4f[!Xu$she8Au3O2ZdCc9<D@y+q+$GdoyJC3w)br~6~o0C@,_Pa} ql');

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

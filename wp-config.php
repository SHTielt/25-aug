<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'tieltvolunt');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'czhCiNF3Guj#3:mNdW<K6Y1-1LXYdp3UMAKr^VMl;o0)Z2`<1!qF_G2fV#VpR{ty');
define('SECURE_AUTH_KEY',  '*3CNUDKI^PAV$dciI{jquJw8C`>P?9HD)bED^lY9+dmSm[5t1ZEvjQW||2G{0y*}');
define('LOGGED_IN_KEY',    '<o$kFw)OAfvyc5!BEbt&O9%C{^2uav#L&IG1m6p,&*BZEH@#B{hi(Wt2j=4N!fq)');
define('NONCE_KEY',        '42kXw!{vfriBrth{5g/ae]- hJ/lID9i}7F#ZrUH+fH0Azj5s$Np`yPQ~l`ZHPv$');
define('AUTH_SALT',        '+l9`dv{Fz+/XjSS,9T0IE?Wlj{K.@K1?ry@d-pH+dBTcU:2Cq5[:Tbpw1J1gl$#7');
define('SECURE_AUTH_SALT', '|n@Kj%nEafy{Mm:]3T~*Cte%p$b+-&)4nTMq=~pd5#FOmxhL,*meT$3)W/.*$p$K');
define('LOGGED_IN_SALT',   'JC^|f3KmQz7C4y_G>t=` V&cbP0kB v|A;)C6a3-?#63px5x!zX5W_8oNg*FWlAU');
define('NONCE_SALT',       'n(i2h=IY%l{`0(nX[ *XHR>NLYxZE4`*RFvCn}BYoVzaNEo[EYCi2t3K2!c59Tw@');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sh_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_POST_REVISIONS',3);
define('WP_MEMORY_LIMIT','128M');
define('AUTOSAVE_INTERVAL',999999);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

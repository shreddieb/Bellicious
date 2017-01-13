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
define('DB_NAME', 'magento_local');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '!lit!E)~y-:2=kV;f|eM?.L>J%^ZtB_umY?@Uby;Tc9VWXR-/R5cz:22!ARMIJ7}');
define('SECURE_AUTH_KEY',  'mnH)@>8{/C-T`ehmKKk,X4nN{Tt#!B1,qF<sR/d?v<LH2_-!_K,,_y8s}W9]4gW+');
define('LOGGED_IN_KEY',    'U3sY+SemTQ]8r9/S<,<T=%m+]RMG8e!v,(g_4,{Ste9gi24%oD2-mMDCH[MFipaV');
define('NONCE_KEY',        '@_!q5pa^ Vq!`77sKPawMx -dk}E$eB!*<Jkx2OW)SYYI4LHBfm}9uQ}<0.~vl$b');
define('AUTH_SALT',        ',d)`8W3jG<$?Swm+De) b8XcrgQ7.`fk.pg!gzq/<w+0XLTPNF$w8*k h;!3A&2=');
define('SECURE_AUTH_SALT', 'Zo2z;td(%}5aL4$+>*a<D;8PLB4FxMG^e{PJGa?&TJMxy,BYm~_Yl14S3Uw@5/+z');
define('LOGGED_IN_SALT',   'Z8C/I1p#Vv+{4la!6;khW*a2{`]MTOHyVr%C5Sl5:ez{Jh<V@qCm<}BCU?I9gFeb');
define('NONCE_SALT',       '-B`RGz-ElFF~i]IPwgx`:?DLFtE_t;~(hh$B._%2ZnIxCbf.qoBES~[j{I5=w85*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sabuj' );

/** MySQL database username */
define( 'DB_USER', 'sabuj' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Cuetcse@0804058' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'w6G&j*$4vTR4lm!}q#I+?5dK/bz#6xe!Pz$McQ^N_e(my44GHKSvy(3Z;lzS2MOd' );
define( 'SECURE_AUTH_KEY',  '!mrb]9+TQ/T,1tBytC80(>Hy^r@.Q_WR8(}XB^e<rgYM,DlwYFu5?XBG^3;CG!X}' );
define( 'LOGGED_IN_KEY',    '<kJ8KcD|MIB@(Ko(2WI>6hYN&:X9Rw0nkh#`:C[IA1l^RNw<khTqGG-Ri/*wL7~U' );
define( 'NONCE_KEY',        'v}Yq_BR%RJ&7;5`YCw-2Y0-8d7&KQ}&s4hHqPi+H4=0aN)r[>;>Te/OrayH7Hj8r' );
define( 'AUTH_SALT',        '3OkqQ2ktTi^55D>D3?MPL&$ez7O*v:aIqPV0V*K)B22a8pwFD(LpKeu>erv<HWOL' );
define( 'SECURE_AUTH_SALT', 'eV&Z2.CcQ;y]})Lv7Nit^e6K&-/?qEthlPSDO7q13K-r OSlo8~fW@V9oXd38|u;' );
define( 'LOGGED_IN_SALT',   'ly`n36f&Fdb#[jZc<C!Fz@ZX_{QIE9,{!|!e$ZfT[BO@mw;9 dBXf!6mX{mK#o5s' );
define( 'NONCE_SALT',       'j-a5CMrP|8--qXY6bbArlFf#p`!kGD4uBmk8%!,cXNgmM4]8%&NgGTF >W2*.k!O' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

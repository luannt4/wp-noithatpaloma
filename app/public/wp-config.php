<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '>BJW!KUy#f)q.u+wHsl.hg%rML0R4_F;{6g>GU9^LD0L@p?(5w6:dHJtk!sRM!_v' );
define( 'SECURE_AUTH_KEY',   'i&rk!?/9QGq `U,MG0!+HRGb8uNJ8@JPLKRyd/z,yeWSaypY>kviE~Ad.x*Xxd7]' );
define( 'LOGGED_IN_KEY',     '`CGc-10OpC`z&k~T@(1Mk=xB~<}FUF1umj_Od_^??d#5.df,?hW;y#2KQ&P_0ph ' );
define( 'NONCE_KEY',         'b)bZ3M2g[:tYejeGNt7RDxV_iNz1TG(T[$#VA02phJh`?<IE`[h>_~zeMoMV6IK|' );
define( 'AUTH_SALT',         'QBwBc)_]X)sA7t%A~l^;h/2<etjH8ejr(6nD:,Lk0o|e!~EH91W3(Y$Q-[T!t0dB' );
define( 'SECURE_AUTH_SALT',  '68z|Jnp=w*pfB#riJwM8]#:-0Zc%aC)afVm7!o+f/b1SCr9v4q(8p-X=c~h|9hM]' );
define( 'LOGGED_IN_SALT',    '0t)tFUN%InHUWqa.KXLPI]8[ehby}*V]EX;y_c$:N&m4BYKxiP/biD})9Q* RFn[' );
define( 'NONCE_SALT',        'sNo*:Ps8:wR $*86-n5| B #(B/`_,H6s^>oJ0J$J*ddX~T[}$(QTq?4Ug>uz#x{' );
define( 'WP_CACHE_KEY_SALT', '30OU8q_~Vf<8hu_em+EO|jDuj&C/+`E7N1#.5kp~^X*E!JavC8Qpxn;8u=;P15&9' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';


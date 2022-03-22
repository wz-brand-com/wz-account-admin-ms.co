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
define( 'DB_NAME', 'wb_tutorial' );

/** MySQL database username */
define( 'DB_USER', 'ramukaka' );

/** MySQL database password */
define( 'DB_PASSWORD', 'KKsjjs6gdhjs' );

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
define( 'AUTH_KEY',         '?wE|odm87G8-AVCEf`:ypu|U=,QCH`0eki&1y1zEY>_a}4JP$|(9lecQhjn;zbpn' );
define( 'SECURE_AUTH_KEY',  '}c{~_<NW*Ak,WO6_7PKmbPuJ[Jy8J,tE(pX>>PGnm Y/AHWe/:<C<}XVjPd{|XV9' );
define( 'LOGGED_IN_KEY',    'Qa,{<GpP<`v_.I`x5.wB}XmCzj74Oxu5Otu[S~B1T[67hKF}`M=n)NB_lvE,jxa/' );
define( 'NONCE_KEY',        'Pe2|N6EzL8@PuU4qTr%8 +6g;m?|)Oli9mdY?lYXZbv}GjDls<a$zc%]E#M@tPkS' );
define( 'AUTH_SALT',        '3q)1;F<GpGW{<2cx(IkhsYnKVk&d|5^s4-R.4ClVL*P2|6/bjr_doJh/sjGy{1*k' );
define( 'SECURE_AUTH_SALT', 'vu(}pmPC;HiuD79<aF) tJ4&y(BJd[Yt%72Rm~4S<N8Sn=|]DcGn]M3lv)d!3i!y' );
define( 'LOGGED_IN_SALT',   'PKIBuo7E-gA7-%uAJ0(%[3pYAl,cq~sk g z)=E2Mo-AZkluH.b.w8A.Qz$3u1pB' );
define( 'NONCE_SALT',       '4h/rw$YK1X8p8Y<nDMH~WIuVLs[h|5s5<]=(yPqC5Da:k24(`hZJk$ Ozj%SK_xm' );

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

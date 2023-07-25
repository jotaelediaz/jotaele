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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dcvkbbbjotaele' );

/** Database username */
define( 'DB_USER', 'dcvkbbbjotaele' );

/** Database password */
define( 'DB_PASSWORD', 'warxi9zivjamrYdroq' );

/** Database hostname */
define( 'DB_HOST', 'dcvkbbbjotaele.mysql.db' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '>bId:Ah[u^v~;d>p3=la4U_MH4O[7sM^N-E4RM]A$aUdC;@41?2YFib@!gvolwFB' );
define( 'SECURE_AUTH_KEY',  '(I5>DA)D*6[K5)GKc9|}YM^PIf^^z:J4,; jL`G~P/5Nslui2kYxSCDS+s|g=6CA' );
define( 'LOGGED_IN_KEY',    'p$ql!veqS3g`pKua)-#.DYlZs>:_cgK[N]!2y>~W`53NMU@o7W8S~l[ |yJv3fD~' );
define( 'NONCE_KEY',        'tOEM@<>bUwkWh5^SDZitk&w VV =Blc,dJIO51ao,^C px$Sfv QCT_^ 4>3Q:3+' );
define( 'AUTH_SALT',        '8`@U{7L:+K[p<BX49%HitC~s&$~]fy,z+vj^vM#y3UT_*MPcb-91L}8VPdu.,C}$' );
define( 'SECURE_AUTH_SALT', 'kQvL5>fzzT$e4Gc)y,CRVZ~qF,$I*oeGx`1:Z,x`bxvg~Z&t1z_77=.9n11iATqA' );
define( 'LOGGED_IN_SALT',   'B7AwA[#xi{5;Su{uH&Aw=GvVnf|7V]D5Z3D;9qhdJd=`E#<(ua7hA NuLp5M?M!2' );
define( 'NONCE_SALT',       'Uc5lEMN4F,_w1(|S/am2]U GRUqkBa1y;d(W/PH*BN,X|H(/5s47&M5%w^`|[K*k' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

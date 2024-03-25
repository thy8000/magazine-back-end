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
define( 'AUTH_KEY',          'mIM6x(X}nyFBC2,6iysf>[dmKYfp `}s8T/yTI+~t=,gl^uGx-YE?|npSmtyl7:v' );
define( 'SECURE_AUTH_KEY',   '<[N-|&:*7E-(a:>JT[uTCh}Tg=Y?ms{Ob~tM=/s`+n3&7rK{g):iV+X.$x<Tp-&d' );
define( 'LOGGED_IN_KEY',     '@r[hy#@wpSs&j5D1[tZ-{YFx)ebxx@Ej`xPUq;gu8*I` p|N+ cd #AB!ucVU&a ' );
define( 'NONCE_KEY',         'YiM2b}_y5S@CC bc)tGKf6oPIrB& r!;_V`/91FAo,D.=L|CW+E9@OKq$g1[y;@>' );
define( 'AUTH_SALT',         'QB@&&}v9Q5efqk]SNS^.&M f(MtMw-g)9&/$`*6CKsC^E$9lBN]?k?2qq|=-,7xM' );
define( 'SECURE_AUTH_SALT',  'rZ*R|K`rN}8Ikc)9_fO^Y#QVe9Sc(rcgOe$tN+7kQl:(|U3e`TdBKa4oh(LT^0zx' );
define( 'LOGGED_IN_SALT',    'G?>7=qa`Bu*yy5(3h*BA!UYQgIu#=u[@ejnIF*|?x1p-41%FRoEQD.VNvBo?}|+6' );
define( 'NONCE_SALT',        'wEXTmzl!oQv1/,dJn`D`mIt7gnXRvMzXGKu{/MphjJeOS;Pq`*YNhF#uJ4*pe8ib' );
define( 'WP_CACHE_KEY_SALT', 'Q{vEK,$k:C bdEY$=0TGEAqrsgh$YC@y(]$3)({Xuxpy;E%9vs9rPjy+ov!QT,n0' );


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

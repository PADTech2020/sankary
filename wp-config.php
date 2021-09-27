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
define( 'DB_NAME', 'sankary' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '-|DoB,k*}@H`>/0}(hCMbpKT2;@hR*X(Cz)fnd/$.G)%y^=[1!j$X36.xe`E:dDP' );
define( 'SECURE_AUTH_KEY',  'QtQR:4J|Sv9k,LYU1INkv.M=Jh2YJZiK l!+#(U2}C<Zhp4{RR#e4h}:yG$mH7lR' );
define( 'LOGGED_IN_KEY',    ',;Wg#H3/;>cg$+PuHSu6-cL4|L72@LSF-RV>j%L.fEhjZr>*9m!S|f*X~cH$H<b$' );
define( 'NONCE_KEY',        'FXucz7SfP,{}Z5ll<ml+&SY.R8?f~_sKM``zk,Mc([Nk7yuexQ%r;xG4G^D*xr.x' );
define( 'AUTH_SALT',        'JIPc_5kHo(]Q?F`HhyIB*!nmEVY80gwo~%^WE@<fb}#3Fh^zT[K=iBCP9wg2D5e0' );
define( 'SECURE_AUTH_SALT', 'AUYs@&Oa@oeAV,Tp-7TVHo`D<d]!jg7PC@<;A!JHPe_^UKr0gj,|ed)v`{>>_i!8' );
define( 'LOGGED_IN_SALT',   'f:_>Bv2]]DYsmqSOh_12,t}(YBc;IJd`$#kavw;Waj~p)3]m/W};>-5:;fnw.N7f' );
define( 'NONCE_SALT',       ')#~mArn6/: J**7lf%FAU+}r/@@|A,: XtYUkG>at##`HcKe1fy#x9_M?pDlE2wp' );


define('WP_HOME','http://localhost/sankari');
define('WP_SITEURL','http://localhost/sankari');


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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

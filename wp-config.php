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
define( 'DB_NAME', 'WordPress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '12345678' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'uJX{o6z20eDI>v].se#+ jN`^JPAV=9_Vt`MI$N+{o;WS[so#3!UBsQ UWkNp-8_' );
define( 'SECURE_AUTH_KEY',  '<C~mQ,CUeB`[hYJnc4a.EDgO3X2fgB;7_`5ll3_wsDUrZ8ApPsDr,D$f9*G(h(2B' );
define( 'LOGGED_IN_KEY',    'Elk@,; qjc+Gpgf^i*1*wo`j3rP~Hg#X<&iy@dD+()/`^69<|kLom/?c<2O@x*/0' );
define( 'NONCE_KEY',        'L2e5g)fQN;J(<:K|t9%Nn<7o_#7%X,<)(1r;zTr_A;VIe{W3$q9)2NjO<.kX)oN+' );
define( 'AUTH_SALT',        'JXRB8#]STXj&:b^,I+(Pv~YU*WdmfhL97%Wj$G%IqA9z7yz+P/ja!D;2w#=08`/`' );
define( 'SECURE_AUTH_SALT', '4Q56vH-.iZ)X|brNBKWu9+S{Po>7W$9Rkh0)g!dhWbA(DNRbgk!+V)c(Nhr;e?qT' );
define( 'LOGGED_IN_SALT',   'EJ$O;Xfk| Zu>H];~L,b%7r(ZmA%}oVg.A|l:h:,g3d $#9^1LA?nU~=p|thnte2' );
define( 'NONCE_SALT',       '/fn[a$<xYvB^Tk`?x=ZR<E^6+sH.W=q(PN]r?1jE l4ZgI)6U^<n:eo0zQ_W(^%j' );

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

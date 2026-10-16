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
define( 'DB_NAME', 'harshit_grocery' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',          'gGjAUQX}11I[@2IGj1Ox$FfJI.*ZDGRJ<t1&T7rjev@>QE(ko94pjAF*u#&}&v4Y' );
define( 'SECURE_AUTH_KEY',   'dz!?Y!)OV4K]5q%(Qt:EfJjia]*ll5xr9kpi,ONoHnUUUrHI=iM:XA{U?0/Rb+I*' );
define( 'LOGGED_IN_KEY',     'i9Y8qMg925`6^<[,ROdtvk5#p<?d^#3}|-TH7O(dZ1R9}^L<>p*yO1zqgt%S^R77' );
define( 'NONCE_KEY',         'adY3&+F-sPpzu*P3c8i* UB<u6Iq@(gF b0(BW;gjAm6T?SI192F7AekwI$5nH5*' );
define( 'AUTH_SALT',         'T3v$* RFZ4hd!%zZ]h#@OK=x$#^,VkH^iga}|NGE[qs<aRRj)A@yd;(g@ s.Qc?x' );
define( 'SECURE_AUTH_SALT',  ',CG;, lD4Bpg<2#AWHT=6c1ytBV!:y5jU6kdn<A{E<CWStt;*A)}O|hwo`eV!3,X' );
define( 'LOGGED_IN_SALT',    'oWg16u=[}yv?cR8nzWELkI-RK 2RQ*+0)`/J`pjTtL)=/YqaBZ+&5A#(1OGq{b@C' );
define( 'NONCE_SALT',        '3?%Q`i26Z&}tbEc=L<MHf@%GLIXI`o$.VV4f$B/J z-&3QM+x.OhE>fDFk~x0 I7' );
define( 'WP_CACHE_KEY_SALT', 'p?s-B{N8Rl16SC&)S]Z;*3$ILX7tfs3(|j;4$CQxZ9 ,:sr;UF+MQ5f+g(JA?8^4' );


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

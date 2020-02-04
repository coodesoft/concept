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
define( 'DB_NAME', 'db_concept' );

/** MySQL database username */
define( 'DB_USER', 'concept' );

/** MySQL database password */
define( 'DB_PASSWORD', '**c0nc3p7**' );

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
define( 'AUTH_KEY',         'j/tD;6S=FzX))6uFTn7SwIOQ~/%xpf{wbmO2>B@NS)1MsS7,c6;koB~1$&i,^i:h' );
define( 'SECURE_AUTH_KEY',  'FEVKH;R^E6^E/oL,!hd7HfO2:*oOqepPK6akW%DZu^f4U#mfM}pE?M^=O9&Tuzg;' );
define( 'LOGGED_IN_KEY',    'eA~b]mI=tXIi10+Cg!D2f!vFs??@#RRCR71KN_azh-4q=);E=.+Mc`(V&n}}prj,' );
define( 'NONCE_KEY',        '2_;cSDX$QXeT#$WPAJ51EDDp%Utd(t(]7?(`zfV8V^+p4D%RTZLP+wqyGpUj7?x1' );
define( 'AUTH_SALT',        '#eUT:m36%xav!*U;CSutt[7U,FRb>j%3H,LK|`5deX$gJB}qQ(/E[1uO6YD?uX9E' );
define( 'SECURE_AUTH_SALT', 'e?|uUB3_yZ5lQB6)5]q=JC%Ajz]Dt]M6>AM:4a9.F|^8miN^s6?JT(RlV|iE=K!m' );
define( 'LOGGED_IN_SALT',   'uT0|u(R-FLSFwii WIL7Bb:&!!G~YnPa]k>M82JWckry(kbkp;rgyCUyk&>`a[*?' );
define( 'NONCE_SALT',       'BAD@9igbEb:>B*4JC2`Y%C*7g$,xFy[_/-a$ss;I6R#r(Zcb$pD+t4?F`{7SySO{' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );

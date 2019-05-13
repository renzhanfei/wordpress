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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '123456' );

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
define( 'AUTH_KEY',         'ur>KGk%<gf34m5;,245)0,Qo.qv^fAApfU.#~n@y&HC%nAg6rmABg#ZF=g>F E.G' );
define( 'SECURE_AUTH_KEY',  'JZY9V5Mo&3^2f5P$}|~R|vxWgTc{u}B;^:B!q%J0>qN,;HX_lPm23R7tU|oZgm=<' );
define( 'LOGGED_IN_KEY',    '~VLXy9kK1:C2Mc5x^caj2-]Im^z38!vQ:9^/3aiOz87g`Vm]I*x^L9{LKal-e&9r' );
define( 'NONCE_KEY',        'Q~+g~C}YC08ee3^Z{on}K*/!B_m:GZBgfdSKjeYC{zU]8%AG#Q2Wjq&VKmgOJ}0s' );
define( 'AUTH_SALT',        'vJ+un/bMN v^_mCi$e6JWZ7xE]mw_W,!B(+}B +h!Q1vGf,}arycz2<u#AoTY9X#' );
define( 'SECURE_AUTH_SALT', 'h5u$K6GF_RDaA%22gzb~1]Rx.;{Avcg^l.@Q8GGNST1G >6<]c6Z=NNL,#(~i,Tx' );
define( 'LOGGED_IN_SALT',   '4EVv,&cS2=x6d]O_heE;<=uUiPl~W$oiU%IIBXK|A/42myXojFGn$8E$k>*$!/+b' );
define( 'NONCE_SALT',       'K8CviBI6NziX?kX{yJv=p*GlITiCOOHqyHMM aeCVS(~$<Bs+kMHpOvmxD( p We' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'en_';

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

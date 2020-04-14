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
define( 'DB_NAME', 'shopfiluk' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'shopfiluk' );

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
define( 'AUTH_KEY',         ']7y<D^_?h=cUr_,qi #w8)k(U0[~Umukqo%4^cmi-XIi>B$90i*Y+&58=9X`$l!w' );
define( 'SECURE_AUTH_KEY',  'a?c7j#iHT*S>ObRl ;>s 49!0h]>*6]wKUoWfpg;5XggTL+/{)3#BX]t+iVWUt~,' );
define( 'LOGGED_IN_KEY',    '?v>^k`~;2Xb;3R]<-.q.|9{Mk@)y?kuM^-.UN?rN6!}+NZw:!5EH`5f@<Nf1pK6M' );
define( 'NONCE_KEY',        'W4<#Q(,Z MaTp9Rn~x?yy3%>ZTloVu6~fz9Yc_^3>,[gZ=#f4zi31%dPL:NGX|bM' );
define( 'AUTH_SALT',        'NQg:yY8JMwB=IvtV,l+Ts NM3)8Q0~%vdH_LF!$]>:|&9<D`oM8d1_|B!@`ZeP|,' );
define( 'SECURE_AUTH_SALT', '  8]SyzE>Q=T-m|wJgt^HA+5s-F$$XpY=Lj1+98s8c/@KnRaByg~3h+6s`Wj1iaq' );
define( 'LOGGED_IN_SALT',   ';VF`-CINTkW-CV{r?qDHu1>zo$,y.Nj6=wgQ,|7)Z{SHi#?+AAxnx@@|Z]Gk#hJn' );
define( 'NONCE_SALT',       'tI>9wxb(?bMWnK]i$Qk+#.7,Wl#34/iokOR|qU@X,V.^*@(!tJrWe]^5ycC#WH2J' );

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

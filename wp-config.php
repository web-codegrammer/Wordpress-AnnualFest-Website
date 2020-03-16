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
define('DB_NAME', 'wordpress_a4');

/** MySQL database username */
define('DB_USER', 'wordpress_98');

/** MySQL database password */
define('DB_PASSWORD', 'O9lJa!R0y4');

/** MySQL hostname */
define('DB_HOST', '182.50.133.92:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'MlF7L6(@8YVMCMqt5zrKRtCoXK7pldqOjLG7(g%H5hPSQIxVEmg!deqLVEA^L6Hy');
define('SECURE_AUTH_KEY',  'lACp4S326@v0dD*1S0d*y55J!SlcjDzQQXj*WCFeJV(N#aqanUL1u4XwCwQ^6Fu^');
define('LOGGED_IN_KEY',    '@xWueS4Q55bjgYbA@Nptxq0PymynoEZKxceZZ1OWEe(PCmv*6NecU2i%tH0nwcc@');
define('NONCE_KEY',        'Q69GTRzThVGD!lZhgascezBVTV(pGPxL1Y2@0mw)35W*h)BX9vAXbop7LN8UbocL');
define('AUTH_SALT',        'FFs)0aom#hAfEmDs())PNCwUaClmYg)ir^H6iXyCBWYd#wVZjP&BemJ%W3gyRbuc');
define('SECURE_AUTH_SALT', 'dA8N^dMM%lTT)zQgHKQk^k*qSf(JWdnXsK3Jtg6vdS4lJ9c(UlwnAvoExicXIgDt');
define('LOGGED_IN_SALT',   '&cpDz4wENZlkzj7tD!TSMqkXvovZxh4i)ZqwnORw8jEEeMqoVnGR28tuc^*&oG)M');
define('NONCE_SALT',       '!omLx0Gab#y!x(zfn9DTzMVabxdEXgCla1rXBrCxkfWWKrTsys!4IXd@*bupFjJD');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'da_wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
define('WP_CACHE', true);
define('COOKIE_DOMAIN', 'bharatiyam.net');
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');

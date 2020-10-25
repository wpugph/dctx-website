<?php //phpcs:disable
/*
 * Don't show deprecations
 */
error_reporting( E_ALL ^ E_DEPRECATED );

/**
 * Set root path
 */
$rootPath = realpath( __DIR__ . '/..' );

/**
 * Include the Composer autoload
 */
require_once $rootPath . '/vendor/autoload.php';

/*
 * Fetch .env
 */
if ( ! isset( $_ENV['PANTHEON_ENVIRONMENT'] ) && file_exists( $rootPath . '/.env' ) ) {
	$dotenv = Dotenv\Dotenv::create( $rootPath );
	$dotenv->load();
	$dotenv->required(
		array(
			'DB_NAME',
			'DB_USER',
			'DB_HOST',
		)
	)->notEmpty();
}

/**
 * Disallow on server file edits
 */
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISALLOW_FILE_MODS', true );

/**
 * Force SSL
 */
define( 'FORCE_SSL_ADMIN', true );

/**
 * Limit post revisions
 */
define( 'WP_POST_REVISIONS', 3 );

/*
 * If NOT on Pantheon
 */
if ( ! isset( $_ENV['PANTHEON_ENVIRONMENT'] ) ) :
	/**
	 * Define site and home URLs
	 */
	// HTTP is still the default scheme for now.
	$scheme = 'http';
	// If we have detected that the end use is HTTPS, make sure we pass that
	// through here, so <img> tags and the like don't generate mixed-mode
	// content warnings.
	if ( isset( $_SERVER['HTTP_USER_AGENT_HTTPS'] ) && $_SERVER['HTTP_USER_AGENT_HTTPS'] == 'ON' ) {
		$scheme = 'https';
	}
	$site_url = getenv( 'WP_HOME' ) !== false ? getenv( 'WP_HOME' ) : $scheme . '://' . $_SERVER['HTTP_HOST'] . '/';
	define( 'WP_HOME', $site_url );
	define( 'WP_SITEURL', $site_url . 'wp/' );

	/**
	 * Set Database Details
	 */
	define( 'DB_NAME', getenv( 'DB_NAME' ) );
	define( 'DB_USER', getenv( 'DB_USER' ) );
	define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) !== false ? getenv( 'DB_PASSWORD' ) : '' );
	define( 'DB_HOST', getenv( 'DB_HOST' ) );

	/**
	 * Set debug modes
	 */
	define( 'WP_DEBUG', getenv( 'WP_DEBUG' ) === 'true' ? true : false );
	define( 'IS_LOCAL', getenv( 'IS_LOCAL' ) !== false ? true : false );

	/**#@+
	 * Authentication Unique Keys and Salts.
	 *
	 * Change these to different unique phrases!
	 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
	 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
	 *
	 * @since 2.6.0
	 */
	define( 'AUTH_KEY', $_ENV['AUTH_KEY'] );
	define( 'SECURE_AUTH_KEY', $_ENV['SECURE_AUTH_KEY'] );
	define( 'LOGGED_IN_KEY', $_ENV['LOGGED_IN_KEY'] );
	define( 'NONCE_KEY', $_ENV['NONCE_KEY'] );
	define( 'AUTH_SALT', $_ENV['AUTH_SALT'] );
	define( 'SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] );
	define( 'LOGGED_IN_SALT', $_ENV['LOGGED_IN_SALT'] );
	define( 'NONCE_SALT', $_ENV['NONCE_SALT'] );

endif;

/*
 * If on Pantheon
 */
if ( isset( $_ENV['PANTHEON_ENVIRONMENT'] ) ) :

	// ** MySQL settings - included in the Pantheon Environment ** //
	/** The name of the database for WordPress */
	define( 'DB_NAME', $_ENV['DB_NAME'] );

	/** MySQL database username */
	define( 'DB_USER', $_ENV['DB_USER'] );

	/** MySQL database password */
	define( 'DB_PASSWORD', $_ENV['DB_PASSWORD'] );

	/** MySQL hostname; on Pantheon this includes a specific port number. */
	define( 'DB_HOST', $_ENV['DB_HOST'] . ':' . $_ENV['DB_PORT'] );

	/** Database Charset to use in creating database tables. */
	define( 'DB_CHARSET', 'utf8' );

	/** The Database Collate type. Don't change this if in doubt. */
	define( 'DB_COLLATE', '' );

	/**#@+
	 * Authentication Unique Keys and Salts.
	 *
	 * Change these to different unique phrases!
	 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
	 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
	 *
	 * Pantheon sets these values for you also. If you want to shuffle them you
	 * can do so via your dashboard.
	 *
	 * @since 2.6.0
	 */
	define( 'AUTH_KEY', $_ENV['AUTH_KEY'] );
	define( 'SECURE_AUTH_KEY', $_ENV['SECURE_AUTH_KEY'] );
	define( 'LOGGED_IN_KEY', $_ENV['LOGGED_IN_KEY'] );
	define( 'NONCE_KEY', $_ENV['NONCE_KEY'] );
	define( 'AUTH_SALT', $_ENV['AUTH_SALT'] );
	define( 'SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT'] );
	define( 'LOGGED_IN_SALT', $_ENV['LOGGED_IN_SALT'] );
	define( 'NONCE_SALT', $_ENV['NONCE_SALT'] );
	/**#@-*/

	/** A couple extra tweaks to help things run well on Pantheon. */
	if ( isset( $_SERVER['HTTP_HOST'] ) ) {
		// HTTP is still the default scheme for now.
		$scheme = 'http';
		// If we have detected that the end use is HTTPS, make sure we pass that
		// through here, so <img> tags and the like don't generate mixed-mode
		// content warnings.
		if ( isset( $_SERVER['HTTP_USER_AGENT_HTTPS'] ) && $_SERVER['HTTP_USER_AGENT_HTTPS'] == 'ON' ) {
			$scheme = 'https';
		}
		define( 'WP_HOME', $scheme . '://' . $_SERVER['HTTP_HOST'] );
		define( 'WP_SITEURL', $scheme . '://' . $_SERVER['HTTP_HOST'] . '/wp' );

	}

	// Force the use of a safe temp directory when in a container
	if ( defined( 'PANTHEON_BINDING' ) ) :
		define( 'WP_TEMP_DIR', sprintf( '/srv/bindings/%s/tmp', PANTHEON_BINDING ) );
	endif;

	// FS writes aren't permitted in test or live, so we should let WordPress know to disable relevant UI
	if ( in_array( $_ENV['PANTHEON_ENVIRONMENT'], array( 'test', 'live' ) ) && ! defined( 'DISALLOW_FILE_MODS' ) ) :
		define( 'DISALLOW_FILE_MODS', true );
	endif;

endif;

/*
* Define wp-content directory outside of WordPress core directory
*/
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/wp-content' );
define( 'WP_CONTENT_URL', WP_HOME . '/wp-content' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = getenv( 'DB_PREFIX' ) !== false ? getenv( 'DB_PREFIX' ) : 'wp_';

if ( file_exists( dirname( __FILE__ ) . '/wp-content/uploads/private/wp-config-redirect.php' ) && ! isset( $_ENV['PANTHEON_ENVIRONMENT'] ) ) {
	require_once dirname( __FILE__ ) . '/wp-content/uploads/private/wp-config-redirect.php';
}

if (isset($_ENV['PANTHEON_ENVIRONMENT']) && php_sapi_name() != 'cli') {
	// Redirect to https://$primary_domain in the Live environment
	if ($_ENV['PANTHEON_ENVIRONMENT'] === 'dev') {
		if ( ($_SERVER['HTTP_HOST'] == 'dev-dctx1.pantheonsite.io') ) {
			$primary_domain = 'dev.dctx.ph';
		}
		$primary_domain = $_SERVER['HTTP_HOST'];
	} else if ($_ENV['PANTHEON_ENVIRONMENT'] === 'test') {
		if ( ($_SERVER['HTTP_HOST'] == 'test-dctx1.pantheonsite.io') ) {
			$primary_domain = 'test.dctx.ph';
		}
		$primary_domain = $_SERVER['HTTP_HOST'];
	} else if ($_ENV['PANTHEON_ENVIRONMENT'] === 'live') {
		if ( ($_SERVER['HTTP_HOST'] == 'live-dctx1.pantheonsite.io') ) {
			$primary_domain = 'dctx.ph';
		}
		$primary_domain = $_SERVER['HTTP_HOST'];
	}else {
	  // Redirect to HTTPS on every Pantheon environment.
	  $primary_domain = $_SERVER['HTTP_HOST'];
	}
  
	$requires_redirect = false;
	
	// Ensure the site is being served from the primary domain.
	if ($_SERVER['HTTP_HOST'] != $primary_domain) {
	  $requires_redirect = true;
	}
  
	// If you're not using HSTS in the pantheon.yml file, uncomment this next block.
	// if (!isset($_SERVER['HTTP_USER_AGENT_HTTPS'])
	//     || $_SERVER['HTTP_USER_AGENT_HTTPS'] != 'ON') {
	//   $requires_redirect = true;
	// }
  
	if ($requires_redirect === true) {
  
	  // Name transaction "redirect" in New Relic for improved reporting (optional).
	  if (extension_loaded('newrelic')) {
		newrelic_name_transaction("redirect");
	  }
  
	  header('HTTP/1.0 301 Moved Permanently');
	  header('Location: https://'. $primary_domain . $_SERVER['REQUEST_URI']);
	  exit();
	}
  }

/** Changes location where Autoptimize stores optimized files */
define('AUTOPTIMIZE_CACHE_CHILD_DIR','/uploads/autoptimize/');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

<?php
/**
 * Compatibility Mode: ACF function names for themes built for ACF.
 *
 * @package CFMB\Compat
 */

namespace CFMB\Compat;

defined( 'ABSPATH' ) || exit;

/**
 * While this plugin is active, the functions in functions.php (get_field(),
 * have_rows() and the rest) exist and call their cfmb_ versions, so templates
 * written for ACF keep working.
 *
 * It never runs next to ACF, ACF Pro or Secure Custom Fields: when one of
 * them is active the functions are not defined and a notice says why. Each
 * function is also guarded with function_exists().
 */
class Compat_Mode {

	/**
	 * Plugin folder.
	 *
	 * @var string
	 */
	private $dir;

	/**
	 * Why the functions were not loaded, or empty when they were.
	 *
	 * @var string
	 */
	private $skipped = '';

	/**
	 * Constructor.
	 *
	 * @param string $dir Plugin folder.
	 */
	public function __construct( string $dir ) {
		$this->dir = $dir;
	}

	/**
	 * Load the functions, or record why not.
	 *
	 * @return void
	 */
	public function boot(): void {
		add_action( 'admin_notices', array( $this, 'notice' ) );

		if ( ! function_exists( 'cfmb' ) || ! function_exists( 'cfmb_get_field' ) ) {
			$this->skipped = 'cfmb';
			return;
		}

		$blocker = self::blocker();

		if ( '' !== $blocker ) {
			$this->skipped = $blocker;
			return;
		}

		require_once $this->dir . '/src/Object_Map.php';
		require_once $this->dir . '/src/functions.php';
	}

	/**
	 * Name of the active plugin that defines the ACF functions itself, or empty.
	 *
	 * @return string
	 */
	public static function blocker(): string {
		if ( defined( 'SCF_VERSION' ) || class_exists( 'SCF' ) ) {
			return 'Secure Custom Fields';
		}

		if ( defined( 'ACF_PRO' ) && ACF_PRO ) {
			return 'ACF Pro';
		}

		if ( class_exists( 'ACF' ) || defined( 'ACF_VERSION' ) ) {
			return 'Advanced Custom Fields';
		}

		return '';
	}

	/**
	 * Say why the functions are off, on the Plugins screen and CFMB screens.
	 *
	 * @return void
	 */
	public function notice(): void {
		if ( '' === $this->skipped || ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		$id     = $screen ? (string) $screen->id : '';

		if ( 'plugins' !== $id && false === strpos( $id, 'cfmb' ) ) {
			return;
		}

		$message = 'cfmb' === $this->skipped
			? __( 'CFMB Compatibility Mode needs CFMB - Custom Fields Meta Box. Activate it to use get_field() and the other ACF functions.', 'cfmb-compatibility-mode' )
			: sprintf(
				/* translators: %s: plugin name, e.g. Advanced Custom Fields */
				__( 'CFMB Compatibility Mode is paused because %s is active, and it defines get_field() and the other ACF functions itself. Deactivate it to let CFMB answer those calls.', 'cfmb-compatibility-mode' ),
				$this->skipped
			);

		printf( '<div class="notice notice-warning"><p>%s</p></div>', esc_html( $message ) );
	}
}

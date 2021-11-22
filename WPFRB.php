<?php
/**
 * Feature Request Board
 *
 * @package WPFRB
 * @author  HrDelwar
 * @copyright 2019 AuthLab
 * @license GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Feature Request Board
 * Plugin Uri:        https://example.com/plugins/feature-request-board/
 * Description:       Handle the basic feature request
 * Version:           1.0.0
 * Requires at last:  5.2
 * Requires PHP:      7.2
 * Author:            Habibur Rahman Delwar
 * Author URI:        https://hrdelwar.netlify.app/
 * License:           GPL v2 or later
 * Licence URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       feature-request-board
 * Domain Path:       /languages
 */


if (!defined('ABSPATH')) {
    die;
}

require_once __DIR__ . '/vendor/autoload.php';

class WPFRB
{
    /**
     * Define Plugin Version
     */
    const VERSION = '1.0.0';
    // constructor
    public function __construct()
    {
        $this->plugin_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);
        add_action('plugins_loaded', [$this, 'init']);
    }


    /**
     * Plugin Constants
     * @since 1.0.0
     */
    public function plugin_constants()
    {
        define('WPFRB_VERSION', self::VERSION);
        define('WPFRB_PLUGIN_PATH', __FILE__);
        define('WPFRB_PLUGIN_URL', trailingslashit(plugin_dir_url(__FILE__)));
        define('WPFRB_ASSETS', WPFRB_PLUGIN_URL . 'assets');
        define('WPFRB_NONCE', 'wpfrb54321');
        define('WPFRB_frb_board', 'wpfrb_frb_board');
        define('WPFRB_frb_request_list', 'wpfrb_frb_request_list');
    }

    /**
     *  Self Instance
     * @since 1.0.0
     */
    public static function instance()
    {
        static $instance = null;
        if (is_null($instance)) {
            $instance = new self();
        }
        return $instance;
    }

    /**
     * Plugin Activation
     * @since 1.0.0
     */
    public function activate()
    {
        $installed = get_option( 'wpfrb_installed' );
        if ( ! $installed ) {
            update_option( 'wpfrb_installed', time() );
        }
        update_option( 'wpfrb_version',  WPFRB_VERSION);
        $tables = new \Hr\WpFRB\Hooks\Tables();
        $tables->wpfrb_create_tables();
    }


    /**
     * Plugin Deactivation
     * @since 1.0.0
     */
    public function deactivate()
    {

    }

    /**
     * Init Plugin
     * @since 1.0.0
     */
    public function init()
    {
        if (is_admin()) {
            new \Hr\WpFRB\Hooks\Admin();
        }
        new \Hr\WpFRB\Hooks\Assets();
        new \Hr\WpFRB\Router\Router();
        new \Hr\WpFRB\Hooks\Shortcode();
    }
}


/**
 * Initialize Plugin
 * @since 1.0.0
 */
function wpfrb()
{
    return WPFRB::instance();
}

// Run the plugin
wpfrb();
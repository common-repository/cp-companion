<?php
/**
 * Plugin Name: CP Companion
 * Plugin URI: http://centuryplugin.com/
 * Description: This plugin will add custom made elementor elements to elementor page builder to customize sites with ease.
 * Version: 1.0.2
 * Author: Century Plugin
 * Author URI: https://centuryplugin.com
 * Text Domain: cp-companion
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 *
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die();
}

define( 'CP_COMPANION_VERSION', '1.0.5' );

define( 'CP_COMPANION_FILE', __FILE__ );
define( 'CP_COMPANION_PLUGIN_BASENAME', plugin_basename( CP_COMPANION_FILE ) );
define( 'CP_COMPANION_PATH', plugin_dir_path( CP_COMPANION_FILE ) );
define( 'CP_COMPANION_URL', plugins_url( '/', CP_COMPANION_FILE ) );

define( 'CP_COMPANION_ASSETS_URL', CP_COMPANION_URL . 'assets/' );


if ( !class_exists( 'Cp_Companion' ) ) {

    /**
     * Sets up and initializes the plugin.
     */
    class Cp_Companion {

        /**
         * A reference to an instance of this class.
         *
         * @since  1.0.0
         * @access private
         * @var    object
         */
        private static $instance = null;

        /**
         * Plugin version
         *
         * @var string
         */
        private $version = CP_COMPANION_VERSION;

        /**
         * Returns the instance.
         *
         * @since  1.0.0
         * @access public
         * @return object
         */
        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if ( null == self::$instance ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
         * Sets up needed actions/filters for the plugin to initialize.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function __construct() {

            // Load translation files
            add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

            // Load necessary files.
            add_action( 'plugins_loaded', array( $this, 'init' ) );

            add_shortcode( 'POLYLANG', array( $this, 'cp_companion_polylang_flags_shortcode' ) );


        }

        /**
         * Loads the translation files.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function load_plugin_textdomain() {
            load_plugin_textdomain( 'cp-companion', false, basename( dirname( __FILE__ ) ) . '/languages' );
        }

        /**
         * Returns plugin version
         *
         * @return string
         */
        public function get_version() {
            return $this->version;
        }

        /**
         * Manually init required modules.
         *
         * @return void
         */
        public function init() {

            // Check if Elementor installed and activated
            if ( !did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', array( $this, 'required_plugins_notice' ) );
                return;
            }
            
            require( CP_COMPANION_PATH . 'includes/cp-widget-loader.php' );
            require( CP_COMPANION_PATH . 'includes/helper-functions.php' );


        }

   
        /**
         * Show recommended plugins notice.
         *
         * @return void
         */
        public function required_plugins_notice() {
            $screen = get_current_screen();
            if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
                return;
            }

            $plugin = 'elementor/elementor.php';

            if ( $this->is_elementor_installed() ) {
                if ( !current_user_can( 'activate_plugins' ) ) {
                    return;
                }

                $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
                $admin_message = '<p>' . esc_html__( 'Ops! CP Companion is not working because you need to activate the Elementor plugin first.', 'cp-companion' ) . '</p>';
                $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'cp-companion' ) ) . '</p>';
            } else {
                if ( !current_user_can( 'install_plugins' ) ) {
                    return;
                }

                $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
                $admin_message = '<p>' . esc_html__( 'Ops! CP Companion is not working because you need to install the Elementor plugin', 'cp-companion' ) . '</p>';
                $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'cp-companion' ) ) . '</p>';
            }

            echo '<div class="error">' . $admin_message . '</div>';
        }


        

        // Polylang Shortcode Support use [POLYLANG]
        function cp_companion_polylang_flags_shortcode($atts) {
            
            if( ! class_exists('Polylang')){
                return;
            }

            ob_start();
            extract(shortcode_atts(
            array(

                'show_flags'    => '1',
                'show_names'    => '1',
                'dropdown'      => '0'

            ), $atts, 'POLYLANG'));

            pll_the_languages( array( 'show_flags' => $show_flags,'show_names' => $show_names,'dropdown' => $dropdown ) );
            $flags = ob_get_clean();
            if( $dropdown == 0 ){
                return '<ul class="polylang-flags dropdown">' . $flags . '</ul>';
            }else{
                return '<div class="polylang-flags">' . $flags . '</div>';
            }
        }

        

     

        /**
         * Check if theme has elementor installed
         *
         * @return boolean
         */
        public function is_elementor_installed() {
            $file_path = 'elementor/elementor.php';
            $installed_plugins = get_plugins();

            return isset( $installed_plugins[ $file_path ] );
        }

    }

}

if ( !function_exists( 'cp_companion' ) ) {

    /**
     * Returns instanse of the plugin class.
     *
     * @since  1.0.0
     * @return object
     */
    function cp_companion() {
        return Cp_Companion::get_instance();
    }

}

cp_companion();

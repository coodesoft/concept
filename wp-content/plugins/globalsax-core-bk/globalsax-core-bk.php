<?php
/**
 * Plugin Name: GLOBALSAX - Core -BK Extension
 * Description: Plugin que extiende a Globalsax Core con funcionalidades para GrupoBK
 * Plugin URI: https://coodesoft.com.ar
 * Author: Coodesoft Development Team
 * Author URI: https://coodesoft.com.ar
 * Version: 1.0
 * Text Domain: globalsax-core bk
 * License: GPL2
 */

 define('GLOBALSAX_BK_VERSION', '1.0');
 define('GLOBALSAX_BK_PATH', dirname(__FILE__));
 define('GLOBALSAX_BK_FOLDER', basename(GLOBALSAX_BK_PATH));
 define('GLOBALSAX_BK_URL', plugins_url() . '/' . GLOBALSAX_BK_FOLDER);



 /**
  * The plugin base class - the root of all WP goods!
  *
  * @author maikndawer
  */

class GlobalSax_BK {

  public function __construct(){
      register_activation_hook(__FILE__, array($this, 'globalsax_bk_on_activate_callback') );
      add_action('wp_enqueue_scripts', array($this,'globalsax_add_JS'));
      add_action('wp_loaded', array($this, 'loadFunctions'),0);
  }

  private function globalSaxNotFoundMessage() {
    //get the current screen
    $screen = get_current_screen();

    if ( $screen->id !== 'toplevel_page_YOUR_PLUGIN_PAGE_SLUG')
      return;

    $class = 'notice notice-error is-dismissible';
    $message = 'Este plugin es una extensión de GlobalSax Core. El mismo debe estar instalado previamente.';
    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
  }

  public function globalsax_bk_on_activate_callback(){
    $active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
    if ( !in_array( 'globalsax-core/globalsax-plugin-base.php', $active_plugins ) ) {
      add_action( 'user_admin_notices', array($this, 'globalSaxNotFoundMessage') );

    }
  }

  /**
   * Adding JavaScript scripts
   * Loading existing scripts from wp-includes or adding custom ones
   */
  public function globalsax_add_JS() {
      wp_enqueue_script('jquery');
      $deps = array(  'globalsax-script',
                      'globalsax-gs-register',
                      'globalsax-gs-dom-sucursal',
                      'globalsax-gs-state');

  //    wp_register_script('globalsax-gs-state-bk', plugins_url('/js/gs_state_bk.js', __FILE__), array('jquery'), '1.0', true);
  //    wp_enqueue_script('globalsax-gs-state-bk');

      wp_register_script('globalsax-gs-checkout-bk', plugins_url('/js/gs_checkout_bk.js', __FILE__), $deps, '1.0', true);
      wp_enqueue_script('globalsax-gs-checkout-bk');

  }

  public function loadFunctions(){
    require_once('util/State.php');
    require_once('controllers/CheckoutController.php');
    require_once("templates/cart.php");
  }
}

$globalsax_bk_plugin_base = new GlobalSax_BK();

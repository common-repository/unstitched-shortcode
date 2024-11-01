<?php
  /**
   * Plugin Name: Unstitched Shortcode
   * Plugin URI:  https://www.unstitched.xyz/wordpress
   * Description: Allows the insertion of code to display an Unstitched.xyz capsule or outfit within an iframe. The tag to insert a capsule is: <code>[unstitched_capsule id="123"]</code>
   * Version: 1.0.0
   * Author: Unstitched.xyz
   * Author URI: https://www.unstitched.xyz
   * License: GPLv3
   * License URI: https://www.gnu.org/licenses/gpl-3.0.html
   */

  // If accessed directly, exit
  if ( ! defined( 'ABSPATH' ) ) {
    exit;
  }

  if ( !class_exists( 'Unstitched_Shortcode' ) ) {

    /**
     * Class Unstitched Shortcode. Contains everything.
     *
     * @since 1.0
     */
    class Unstitched_Shortcode {

      public function __construct() {
        wp_enqueue_script(
          'customjs',
          plugins_url('js/iframeResizer.js', __FILE__),
          array(),
          '4.1.1',
          false
        );

        add_shortcode( 'unstitched_capsule', array( $this, 'unstitched_capsule_function' ) );
        add_shortcode( 'unstitched_outfit', array( $this, 'unstitched_outfit_function' ) );

      }

      /**
       * Capsule Shortcode build.
       *
       * @since 1.0
       */
      public function unstitched_capsule_function( $atts ) {
        $id = $atts['id'];

        $html = "<!--  unstitched.xyz capsule -->";
        $html .= "<div class=\"unstitched__iframe-wrapper\">";
        $html .= "<iframe id=\"unstitched__iframe_capsule_{$id}\" src=\"https://api.unstitched.xyz/capsules/{$id}/iframe\" width=\"100%\" frameBorder=\"0\" scrolling=\"no\" onload=\"iFrameResize({checkOrigin: false}, '#unstitched__iframe_capsule_{$id}')\">";
        $html .= "    <p>Your browser does not support iframes.</p>";
        $html .= "</iframe>";
        $html .= "</div>";
        $html .= "<!-- END  unstitched.xyz capsule -->";

        return $html;

      }

      /**
       * Outfit Shortcode build.
       *
       * @since 1.0
       */
      public function unstitched_outfit_function( $atts ) {
        $id = $atts['id'];

        $html = "<!--  unstitched.xyz outfit -->";
        $html .= "<div class=\"unstitched__iframe-wrapper\">";
        $html .= "<iframe id=\"unstitched__iframe_outfit_{$id}\" src=\"https://api.unstitched.xyz/outfits/{$id}/embedded\" width=\"100%\" frameBorder=\"0\" scrolling=\"no\" onload=\"iFrameResize({checkOrigin: false}, '#unstitched__iframe_outfit_{$id}')\">";
        $html .= "    <p>Your browser does not support iframes.</p>";
        $html .= "</iframe>";
        $html .= "</div>";
        $html .= "<!-- END  unstitched.xyz outfit -->";

        return $html;

      }

    }

  }

  new Unstitched_Shortcode();
?>
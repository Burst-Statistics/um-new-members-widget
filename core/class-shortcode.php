<?php defined('ABSPATH') or die("you do not have acces to this page!");

class umnm_shortcodes {
  private static $_this;
  function __construct() {
    if ( isset( self::$_this ) )
        wp_die( sprintf( __( '%s is a singleton class and you cannot create a second instance.','cbm' ), get_class( $this ) ) );

    self::$_this = $this;

    add_shortcode("umnm-new-members", array($this, "new_members"));
  }

  static function this() {
    return self::$_this;
  }

  /*
      return a list of clickable thumbs of users that have visited your profile.
  */

  public function new_members(){

    $theme_file = get_stylesheet_directory() . '/ultimate-member/templates/um-members-widgets/new-members.php';
    ob_start();

    if (function_exists('um_fetch_user')){
      if ( file_exists( $theme_file ) ) {
        require $theme_file;
      } else {
        require um_new_members_path . 'templates/new-members.php';
      }
    }

    return ob_get_clean();
  }

}//class closure

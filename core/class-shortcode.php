<?php defined('ABSPATH') or die("you do not have acces to this page!");

class umnm_shortcodes
{
    private static $_this;

    function __construct()
    {
        if (isset(self::$_this))
            wp_die(sprintf(__('%s is a singleton class and you cannot create a second instance.', 'um-new-members-widget'), get_class($this)));

        self::$_this = $this;

        add_shortcode("umnm-new-members", array($this, "new_members"));
    }

    static function this()
    {
        return self::$_this;
    }

    /*
        return a list of clickable thumbs of users that have visited your profile.
    */

    public function new_members($atts = [], $content = null, $tag = '')
    {

        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array)$atts, CASE_LOWER);

        // override default attributes with user attributes
        $atts = shortcode_atts(['number' => 5, 'avatar_size' => 40], $atts, $tag);

        $number_of_members = intval($atts['number']);
        $avatar_size = intval($atts['avatar_size']);
        $exclude_roles = get_option('umnm_exclude_roles');

        $theme_file = get_stylesheet_directory() . '/ultimate-member/templates/um-members-widgets/new-members.php';
        ob_start();

        if (function_exists('um_user')) {
            if (file_exists($theme_file)) {
                require $theme_file;
            } else {
                require um_new_members_path . 'templates/new-members.php';
            }
        }

        return ob_get_clean();
    }

}//class closure

<?php
defined('ABSPATH') or die("you do not have acces to this page!");


global $ultimatemember;
global $um_prefix;

$user_fields = array( 'ID');

$query_args = array(
    'number'      => 5,
    'fields'      => "id",
    'orderby'      => 'registered',
    'order'        => 'DESC',
);
echo '<ul class="umnm-new-members-widget">';
$wp_user_query = new WP_User_Query($query_args);
// Get the results
$users = $wp_user_query->get_results();
if (!empty($users)){
  foreach($users as $user_id){
    um_fetch_user($user_id);
    $user = get_user_by("id", $user_id);
    $date_format = apply_filters("umnm_date_format", get_option('date_format'));
    ?>
    <li>
      <div class="umnm-new-members-widget-pic">
      <a title="<?php echo um_user('display_name')?>" href="<?php echo um_user_profile_url()?>" class="um-tip-n">
        <?php echo get_avatar( $user_id , 40);?>
      </a>
      </div>

      <div class="umnm-new-members-widget-user">

        <div class="umnm-new-members-widget-name">
          <a title="<?php echo um_user('display_name')?>" href="<?php echo um_user_profile_url()?>" class="um-tip-n">
            <?php echo um_user("display_name");?>
          </a>
        </div>

        <div class="umnm-new-members-widget-date">
          <?php echo mysql2date($date_format, $user->user_registered)?>
        </div>
        <div class="um-clear"></div>
    </li>
    <?php
  }
}
um_reset_user();
echo "</ul>";

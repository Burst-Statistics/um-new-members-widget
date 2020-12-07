<?php
/**
 * Adds  widget.
 */
class um_New_Members_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		parent::__construct(
			'um_new_members_widget', // Base ID
			__( 'New members', 'um-new-members-widget' ), // Name
			array( 'description' => __( 'Show the members that have recently registered.', 'um-new-members-widget' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'um_new_members_title', $instance['title'] ) . $args['after_title'];
		}

		$nr_of_members = !empty( $instance['nr_of_members']) ? intval(apply_filters( 'um_new_members_nr_of_members', $instance['nr_of_members'] )) : 5;
        $avatar_size = !empty( $instance['avatar_size']) ? intval(apply_filters( 'um_new_members_nr_of_members', $instance['avatar_size'] )) : 40;

		echo do_shortcode("[umnm-new-members number=$nr_of_members avatar_size=$avatar_size]");

		echo $args['after_widget'];

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New members', 'um-new-members-widget' );
        $nr_of_members = ! empty( $instance['nr_of_members'] ) ? intval($instance['nr_of_members']) : 5;
        $avatar_size = ! empty( $instance['avatar_size'] ) ? intval($instance['avatar_size']) : 40;
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'nr_of_members' ) ); ?>"><?php _e('Number of members to show:','um-new-members-widget')?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'nr_of_members' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nr_of_members' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_html($nr_of_members)?>" size="3">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'avatar_size' ) ); ?>"><?php _e('Size of profile image','um-new-members-widget')?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'avatar_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatar_size' ) ); ?>" type="number" step="1" min="25" value="<?php echo esc_html($avatar_size)?>" size="4">
        </p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['nr_of_members'] = ( ! empty( $new_instance['nr_of_members'] ) ) ? intval( $new_instance['nr_of_members'] ) : 5;
        $instance['avatar_size'] = ( ! empty( $new_instance['avatar_size'] ) ) ? intval( $new_instance['avatar_size'] ) : 40;

		return $instance;
	}

}

function umnm_register_widget() {
	register_widget( 'um_New_Members_Widget');
}
add_action('widgets_init',  'umnm_register_widget');
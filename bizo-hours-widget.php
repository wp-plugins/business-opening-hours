<?php

/**
 * Add BizoHours_Widget widget.
 */
class BizoHours_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'bizohourswidget', // Base ID
			__( 'Business Opening Hours', 'bizo-hours' ), // Name
			array( 'description' => __( 'Business Opening Hours Widget', 'bizo-hours' ), ) // Args
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
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		$bizohours_options = get_option( "bizohours_options" );
		$output =    
		'<table class="bizoh-table bizoh-widget">
			<thead>
				<tr><th>'. __('Day', 'bizo-hours') . '</th><th>'. __('From', 'bizo-hours') . '</th><th>'. __('To', 'bizo-hours') . '</th></tr>
			</thead>
			<tbody>
				<tr class="monday"><td>'. __('Monday', 'bizo-hours') . '</td><td>'. $bizohours_options["mondayfrom"] .'</td><td>'. $bizohours_options["mondayto"] .'</td></tr>
				<tr class="tuesday"><td>'. __('Tuesday', 'bizo-hours') . '</td><td>'. $bizohours_options["tuesdayfrom"] .'</td><td>'. $bizohours_options["tuesdayto"] .'</td></tr>
				<tr class="wednesday"><td>'. __('Wednesday', 'bizo-hours') . '</td><td>'. $bizohours_options["wednesdayfrom"] .'</td><td>'. $bizohours_options["wednesdayto"] .'</td></tr>
				<tr class="thursday"><td>'. __('Thursday', 'bizo-hours') . '</td><td>'. $bizohours_options["thursdayfrom"] .'</td><td>'. $bizohours_options["thursdayto"] .'</td></tr>
				<tr class="friday"><td>'. __('Friday', 'bizo-hours') . '</td><td>'. $bizohours_options["fridayfrom"] .'</td><td>'. $bizohours_options["fridayto"] .'</td></tr>
				<tr class="saturday"><td>'. __('Saturday', 'bizo-hours') . '</td><td>'. $bizohours_options["saturdayfrom"] .'</td><td>'. $bizohours_options["saturdayto"] .'</td></tr>
				<tr class="sunday"><td>'. __('Sunday', 'bizo-hours') . '</td><td>'. $bizohours_options["sundayfrom"] .'</td><td>'. $bizohours_options["sundayto"] .'</td></tr>
		    </tbody>
		</table>';
		
		_e( $output, 'bizo-hours' );
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
		/***INPUT TITLE***/
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Business Opening Hours', 'bizo-hours' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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

		return $instance;
	}

	public function bizohours_shortcode( $args, $instance ) {

		$args = shortcode_atts( array(
			'title' => 'Business Opening Hours',
			'mondayfrom' => '10:00am',
			'mondayto' => '10:00pm',
			'tuesdayfrom' => '10:00am',
			'tuesdayto' => '10:00pm',
			'wednesdayfrom' => '10:00am',
			'wednesdayto' => '10:00pm',
			'thursdayfrom' => '10:00am',
			'thursdayto' => '10:00pm',
			'fridayfrom' => '10:00am',
			'fridayto' => '10:00pm',
			'saturdayfrom' => '10:00am',
			'saturdayto' => '10:00pm',
			'sundayfrom' => '10:00am',
			'sundayto' => '10:00pm',
			'bizohbgcolor' => '#000000',
			'bizohfontcolor' => '#ffffff'

		), $args );

		$bizoh_currentday_style = 'style="background-color:'.$args["bizohbgcolor"].';color:'.$args["bizohfontcolor"].';"';
		$currentday = date("w");
		?>
		<h2><?php echo $args['title']; ?></h2>
		<table class="bizoh-table">
			<thead>
				<tr><th><?php _e('Day', 'bizo-hours'); ?></th><th><?php _e('From', 'bizo-hours'); ?></th><th><?php _e('To', 'bizo-hours'); ?></th></tr>
			</thead>
			<tbody>
				<tr <?php if($currentday == 1){ echo $bizoh_currentday_style;} ?>><td><?php _e('Monday', 'bizo-hours'); ?></td><td><?php echo $args["mondayfrom"]; ?></td><td><?php echo  $args["mondayto"] ?></td></tr>
				<tr <?php if($currentday == 2){ echo $bizoh_currentday_style;} ?>><td><?php _e('Tuesday', 'bizo-hours') ?></td><td><?php echo $args["tuesdayfrom"] ?></td><td><?php echo $args["tuesdayto"] ?></td></tr>
				<tr <?php if($currentday == 3){ echo $bizoh_currentday_style;} ?>><td><?php _e('Wednesday', 'bizo-hours') ?></td><td><?php echo $args["wednesdayfrom"] ?></td><td><?php echo $args["wednesdayto"] ?></td></tr>
				<tr <?php if($currentday == 4){ echo $bizoh_currentday_style;} ?>><td><?php _e('Thursday', 'bizo-hours') ?></td><td><?php echo $args["thursdayfrom"] ?></td><td><?php echo $args["thursdayto"] ?></td></tr>
				<tr <?php if($currentday == 5){ echo $bizoh_currentday_style;} ?>><td><?php _e('Friday', 'bizo-hours') ?></td><td><?php echo $args["fridayfrom"] ?></td><td><?php echo $args["fridayto"] ?></td></tr>
				<tr <?php if($currentday == 6){ echo $bizoh_currentday_style;} ?>><td><?php _e('Saturday', 'bizo-hours') ?></td><td><?php echo $args["saturdayfrom"] ?></td><td><?php echo $args["saturdayto"] ?></td></tr>
				<tr <?php if($currentday == 0){ echo $bizoh_currentday_style;} ?>><td><?php _e('Sunday', 'bizo-hours') ?></td><td><?php echo $args["sundayfrom"] ?></td><td><?php echo $args["sundayto"] ?></td></tr>
		    </tbody>
		</table>
		<?php
	}

} // class BizoHours_Widget

// Generate Shortcode
add_shortcode( 'bizohours', array( 'BizoHours_Widget', 'bizohours_shortcode' ) );

// register BizoHours_Widget widget
function bizohours_register_widget() {
    register_widget( 'BizoHours_Widget' );
}
add_action( 'widgets_init', 'bizohours_register_widget' );

?>
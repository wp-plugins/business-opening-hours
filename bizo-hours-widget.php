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
		$bizoh_currentday_style = 'style="background-color:'.$bizohours_options["bizohbgcolor"].';color:'.$bizohours_options["bizohfontcolor"].';"';
		$timezone = $bizohours_options["timezone"];
		if(empty($timezone))
			$timezone = 'UTC';
		
		$date = new DateTime('now', new DateTimeZone($timezone));
		$currentday = $date->format('w');
		?>
		<table class="bizoh-table bizoh-widget">
			<thead>
				<tr><th><?php _e('Day', 'bizo-hours'); ?></th><th><?php _e('From', 'bizo-hours'); ?></th><th><?php _e('To', 'bizo-hours'); ?></th></tr>
			</thead>
			<tbody>
				<?php if($bizohours_options["mondayfrom"] != 'Close' || $bizohours_options["mondayto"] != 'Close') { ?>
				<tr <?php if($currentday == 1){ echo $bizoh_currentday_style;} ?>><td><?php _e('Monday', 'bizo-hours'); ?></td><td><?php echo $bizohours_options["mondayfrom"]; ?></td><td><?php echo $bizohours_options["mondayto"]; ?></td></tr>
				<?php } else { ?>
				<tr <?php if($currentday == 1){ echo $bizoh_currentday_style;} ?> style="color:#ff0000"><td><?php _e('Monday', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td></tr>
				<?php } ?>
				
				<?php if($bizohours_options["tuesdayfrom"] != 'Close' || $bizohours_options["tuesdayto"] != 'Close') { ?>
				<tr <?php if($currentday == 2){ echo $bizoh_currentday_style;} ?>><td><?php _e('Tuesday', 'bizo-hours'); ?></td><td><?php echo $bizohours_options["tuesdayfrom"]; ?></td><td><?php echo $bizohours_options["tuesdayto"]; ?></td></tr>
				<?php } else { ?>
				<tr <?php if($currentday == 1){ echo $bizoh_currentday_style;} ?> style="color:#ff0000"><td><?php _e('Tuesday', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td></tr>
				<?php } ?>
				
				<?php if($bizohours_options["wednesdayfrom"] != 'Close' || $bizohours_options["wednesdayto"] != 'Close') { ?>
				<tr <?php if($currentday == 3){ echo $bizoh_currentday_style;} ?>><td><?php _e('Wednesday', 'bizo-hours'); ?></td><td><?php echo $bizohours_options["wednesdayfrom"]; ?></td><td><?php echo $bizohours_options["wednesdayto"]; ?></td></tr>
				<?php } else { ?>
				<tr <?php if($currentday == 1){ echo $bizoh_currentday_style;} ?> style="color:#ff0000"><td><?php _e('Wednesday', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td></tr>
				<?php } ?>
				
				<?php if($bizohours_options["thursdayfrom"] != 'Close' || $bizohours_options["thursdayto"] != 'Close') { ?>
				<tr <?php if($currentday == 4){ echo $bizoh_currentday_style;} ?>><td><?php _e('Thursday', 'bizo-hours'); ?></td><td><?php echo $bizohours_options["thursdayfrom"]; ?></td><td><?php echo $bizohours_options["thursdayto"]; ?></td></tr>
				<?php } else { ?>
				<tr <?php if($currentday == 1){ echo $bizoh_currentday_style;} ?> style="color:#ff0000"><td><?php _e('Thursday', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td></tr>
				<?php } ?>
				
				<?php if($bizohours_options["fridayfrom"] != 'Close' || $bizohours_options["fridayto"] != 'Close') { ?>
				<tr <?php if($currentday == 5){ echo $bizoh_currentday_style;} ?>><td><?php _e('Friday', 'bizo-hours'); ?></td><td><?php echo $bizohours_options["fridayfrom"]; ?></td><td><?php echo $bizohours_options["fridayto"]; ?></td></tr>
				<?php } else { ?>
				<tr <?php if($currentday == 1){ echo $bizoh_currentday_style;} ?> style="color:#ff0000"><td><?php _e('Friday', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td></tr>
				<?php } ?>
				
				<?php if($bizohours_options["saturdayfrom"] != 'Close' || $bizohours_options["saturdayto"] != 'Close') { ?>
				<tr <?php if($currentday == 6){ echo $bizoh_currentday_style;} ?>><td><?php _e('Saturday', 'bizo-hours'); ?></td><td><?php echo $bizohours_options["saturdayfrom"]; ?></td><td><?php echo $bizohours_options["saturdayto"]; ?></td></tr>
				<?php } else { ?>
				<tr <?php if($currentday == 1){ echo $bizoh_currentday_style;} ?> style="color:#ff0000"><td><?php _e('Saturday', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td></tr>
				<?php } ?>
				
				<?php if($bizohours_options["sundayfrom"] != 'Close' || $bizohours_options["sundayto"] != 'Close') { ?>
				<tr <?php if($currentday == 0){ echo $bizoh_currentday_style;} ?>><td><?php _e('Sunday', 'bizo-hours'); ?></td><td> <?php echo $bizohours_options["sundayfrom"]; ?></td><td><?php echo $bizohours_options["sundayto"]; ?></td></tr>
				<?php } else { ?>
				<tr <?php if($currentday == 1){ echo $bizoh_currentday_style;} ?> style="color:#ff0000"><td><?php _e('Sunday', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td><td><?php _e('Close', 'bizo-hours'); ?></td></tr>
				<?php } ?>
		    </tbody>
		</table>
		<?php
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

} // class BizoHours_Widget	

// register BizoHours_Widget widget
function bizohours_register_widget() {
    register_widget( 'BizoHours_Widget' );
}
add_action( 'widgets_init', 'bizohours_register_widget' );

?>
<?php 
function bizohours_shortcode( $args, $instance ) {

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
		$bizohours_options = get_option( "bizohours_options" );
		$timezone = $bizohours_options["timezone"];
		if(empty($timezone))
			$timezone = 'UTC';
		
		$date = new DateTime('now', new DateTimeZone($timezone));
		$currentday = $date->format('w');
		
		$output = '';
		$output .=
		'<h2>'. $args["title"] .'</h2>
		<table class="bizoh-table">
			<thead>
				<tr><th>'. __("Day", "bizo-hours") .'</th><th>'. __("From", "bizo-hours") .'</th><th>'. __("To", "bizo-hours") .'</th></tr>
			</thead>
			<tbody>
				<tr '; 
				if ($currentday == 1)
					$output .= $bizoh_currentday_style;
				$output .= ' ><td>'. __("Monday", "bizo-hours") .'</td><td>'. $args["mondayfrom"] .'</td><td>'. $args["mondayto"] .'</td></tr>
				<tr '; 
				if ($currentday == 2)
					$output .= $bizoh_currentday_style;
				$output .= ' ><td>'. __("Tuesday", "bizo-hours") .'</td><td>'. $args["tuesdayfrom"] .'</td><td>'. $args["tuesdayto"] .'</td></tr>
				<tr '; 
				if ($currentday == 3)
					$output .= $bizoh_currentday_style;
				$output .= ' ><td>'. __("Wednesday", "bizo-hours") .'</td><td>'. $args["wednesdayfrom"] .'</td><td>'. $args["wednesdayto"] .'</td></tr>
				<tr '; 
				if ($currentday == 4)
					$output .= $bizoh_currentday_style;
				$output .= ' ><td>'. __("Thursday", "bizo-hours") .'</td><td>'. $args["thursdayfrom"] .'</td><td>'. $args["thursdayto"] .'</td></tr>
				<tr '; 
				if ($currentday == 5)
					$output .= $bizoh_currentday_style;
				$output .= ' ><td>'. __("Friday", "bizo-hours") .'</td><td>'. $args["fridayfrom"] .'</td><td>'. $args["fridayto"] .'</td></tr>
				<tr '; 
				if ($currentday == 6)
					$output .= $bizoh_currentday_style;
				$output .= ' ><td>'. __("Saturday", "bizo-hours") .'</td><td>'. $args["saturdayfrom"] .'</td><td>'. $args["saturdayto"] .'</td></tr>
				<tr '; 
				if ($currentday == 0)
					$output .= $bizoh_currentday_style;
				$output .= ' ><td>'. __("Sunday", "bizo-hours") .'</td><td>'. $args["sundayfrom"] .'</td><td>'. $args["sundayto"] .'</td></tr>
		    </tbody>
		</table>';
	return $output;	
		
}

// Generate Shortcode
add_shortcode( 'bizohours', 'bizohours_shortcode' );


<?php 
	$bizohours_options = get_option( "bizohours_options" );
?>

<script type="text/javascript">
jQuery(document).ready(function() {
'use strict';
	
	/******HIGHLIGHT CURRENT DAY******/
	
	var date = new Date();
	var current_day = date.getDay();
	if(current_day == '0'){
		jQuery('.bizoh-widget .sunday').css({'background-color': '<?php echo $bizohours_options["bizohbgcolor"]; ?>','color': '<?php echo $bizohours_options["bizohfontcolor"]; ?>'});
	}
	else if(current_day == '1'){
		jQuery('.bizoh-widget .monday').css({'background-color': '<?php echo $bizohours_options["bizohbgcolor"]; ?>','color': '<?php echo $bizohours_options["bizohfontcolor"]; ?>'});
	}
	else if(current_day == '2'){
		jQuery('.bizoh-widget .tuesday').css({'background-color': '<?php echo $bizohours_options["bizohbgcolor"]; ?>','color': '<?php echo $bizohours_options["bizohfontcolor"]; ?>'});
	}
	else if(current_day == '3'){
		jQuery('.bizoh-widget .wednesday').css({'background-color': '<?php echo $bizohours_options["bizohbgcolor"]; ?>','color': '<?php echo $bizohours_options["bizohfontcolor"]; ?>'});
	}
	else if(current_day == '4'){
		jQuery('.bizoh-widget .thursday').css({'background-color': '<?php echo $bizohours_options["bizohbgcolor"]; ?>','color': '<?php echo $bizohours_options["bizohfontcolor"]; ?>'});
	}
	else if(current_day == '5'){
		jQuery('.bizoh-widget .friday').css({'background-color': '<?php echo $bizohours_options["bizohbgcolor"]; ?>','color': '<?php echo $bizohours_options["bizohfontcolor"]; ?>'});
	}
	else if(current_day == '6'){
		jQuery('.bizoh-widget .saturday').css({'background-color': '<?php echo $bizohours_options["bizohbgcolor"]; ?>','color': '<?php echo $bizohours_options["bizohfontcolor"]; ?>'});
	}

	jQuery("tr:contains(Close)").css("color", "#ff0000");
});	
</script>
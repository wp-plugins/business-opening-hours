<?php $bizohours_options = get_option( "bizohours_options" ); ?>

<script type="text/javascript">
	jQuery(document).ready(function() {
	'use strict';

		/******TIME FORMAT******/
		
		jQuery('#timeformat').change(function() {
			if(this.value == "24 hours") {
				jQuery('.bizoh-input').timepicker('remove');
				jQuery('.bizoh-input').timepicker({ 'noneOption': [{'label': 'Close', 'value': 'Close'}], 'timeFormat': 'H:i' });
			}	
			else {
				jQuery('.bizoh-input').timepicker('remove');
				jQuery('.bizoh-input').timepicker({'noneOption': [{'label': 'Close', 'value': 'Close'}], 'timeFormat': 'h:i A' });
			}
		});

		/******DEFAULT TIME FORMAT******/

		var value = '<?php echo $bizohours_options["timeformat"]; ?>';
		if( value == '12 hours' || value == '' ) {
			jQuery('.bizoh-input').timepicker({'noneOption': [{'label': 'Close', 'value': 'Close'}], 'timeFormat': 'h:i A'  });
		}
		else {
			jQuery('.bizoh-input').timepicker({'noneOption': [{'label': 'Close', 'value': 'Close'}], 'timeFormat': 'H:i'  });
		}

		jQuery('#mondayfrom').val('<?php echo $bizohours_options["mondayfrom"]; ?>');
		jQuery('#mondayto').val('<?php echo $bizohours_options["mondayto"]; ?>');
		jQuery('#tuesdayfrom').val('<?php echo $bizohours_options["tuesdayfrom"]; ?>');
		jQuery('#tuesdayto').val('<?php echo $bizohours_options["tuesdayto"]; ?>');
		jQuery('#wednesdayfrom').val('<?php echo $bizohours_options["wednesdayfrom"]; ?>');
		jQuery('#wednesdayto').val('<?php echo $bizohours_options["wednesdayto"]; ?>');
		jQuery('#thursdayfrom').val('<?php echo $bizohours_options["thursdayfrom"]; ?>');
		jQuery('#thursdayto').val('<?php echo $bizohours_options["thursdayto"]; ?>');
		jQuery('#fridayfrom').val('<?php echo $bizohours_options["fridayfrom"]; ?>');
		jQuery('#fridayto').val('<?php echo $bizohours_options["fridayto"]; ?>');
		jQuery('#saturdayfrom').val('<?php echo $bizohours_options["saturdayfrom"]; ?>');
		jQuery('#saturdayto').val('<?php echo $bizohours_options["saturdayto"]; ?>');
		jQuery('#sundayfrom').val('<?php echo $bizohours_options["sundayfrom"]; ?>');
		jQuery('#sundayto').val('<?php echo $bizohours_options["sundayto"]; ?>');
		jQuery('#bizohbgcolor').val('<?php echo $bizohours_options["bizohbgcolor"]; ?>');
		jQuery('#bizohfontcolor').val('<?php echo $bizohours_options["bizohfontcolor"]; ?>');

		/******GENERATE SHORTCODE******/
		function bizohours_genrate_shortcode(){
			jQuery('#genrated-shortcode').val( "[bizohours title='Business Opening Hours' mondayfrom='"+jQuery('#mondayfrom').val()+"' mondayto='"+jQuery('#mondayto').val()+"' tuesdayfrom='"+jQuery('#tuesdayfrom').val()+"' tuesdayto='"+jQuery('#tuesdayto').val()+"' wednesdayfrom='"+jQuery('#wednesdayfrom').val()+"' wednesdayto='"+jQuery('#wednesdayto').val()+"' thursdayfrom='"+jQuery('#thursdayfrom').val()+"' thursdayto='"+jQuery('#thursdayto').val()+"' fridayfrom='"+jQuery('#fridayfrom').val()+"' fridayto='"+jQuery('#fridayto').val()+"' saturdayfrom='"+jQuery('#saturdayfrom').val()+"' saturdayto='"+jQuery('#saturdayto').val()+"' sundayfrom='"+jQuery('#sundayfrom').val()+"' sundayto='"+jQuery('#sundayto').val()+"' bizohbgcolor='"+jQuery('#bizohbgcolor').val()+"' bizohfontcolor='"+jQuery('#bizohfontcolor').val()+"']" );	
		}

		function bizohours_genrate_cshortcode(bizohbgcolor, bizohfontcolor){
			jQuery('#genrated-shortcode').val( "[bizohours title='Business Opening Hours' mondayfrom='"+jQuery('#mondayfrom').val()+"' mondayto='"+jQuery('#mondayto').val()+"' tuesdayfrom='"+jQuery('#tuesdayfrom').val()+"' tuesdayto='"+jQuery('#tuesdayto').val()+"' wednesdayfrom='"+jQuery('#wednesdayfrom').val()+"' wednesdayto='"+jQuery('#wednesdayto').val()+"' thursdayfrom='"+jQuery('#thursdayfrom').val()+"' thursdayto='"+jQuery('#thursdayto').val()+"' fridayfrom='"+jQuery('#fridayfrom').val()+"' fridayto='"+jQuery('#fridayto').val()+"' saturdayfrom='"+jQuery('#saturdayfrom').val()+"' saturdayto='"+jQuery('#saturdayto').val()+"' sundayfrom='"+jQuery('#sundayfrom').val()+"' sundayto='"+jQuery('#sundayto').val()+"' bizohbgcolor='"+bizohbgcolor+"' bizohfontcolor='"+bizohfontcolor+"']" );
		}
	

		/******HIGHLIGHT CURRENT DAY COLOR PICKER******/	
		
		jQuery('.bizoh-highlight-color').wpColorPicker({ defaultColor: '<?php echo $bizohours_options["bizohbgcolor"]; ?>', change: function(event, ui) {
			bizohours_genrate_cshortcode( ui.color.toString() , jQuery('#bizohfontcolor').val() );
		}});

		jQuery('.bizoh-highlight-font-color').wpColorPicker({defaultColor: '<?php echo $bizohours_options["bizohfontcolor"]; ?>', change: function(event, ui) {
			bizohours_genrate_cshortcode( jQuery('#bizohbgcolor').val(), ui.color.toString() );
		}});
		
		// On Changing inputs call
		jQuery('#mondayfrom,#mondayto,#tuesdayfrom,#tuesdayto,#wednesdayfrom,#wednesdayto,#thursdayfrom,#thursdayto,#fridayfrom,#fridayto,#saturdayfrom,#saturdayto,#sundayfrom,#sundayto').change(function() {
			bizohours_genrate_shortcode();
		});

		// Default Call
		bizohours_genrate_shortcode();
		
	});	
</script>
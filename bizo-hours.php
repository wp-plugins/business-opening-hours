<?php
/*
	Plugin Name: Business Hours Lite
	Plugin URI: http://www.sketchthemes.com
	Description: Business Opening Hours Lite Plugin gives out the easiest ways to manage all your business opening hours including office timings,shop hours and store hours.The richly featured Business Opening Hours Lite performs well with various websites which are much concerned about maintaining time discipline.
	Version: 1.0.2
	Author: SketchThemes
	Author URI: http://www.sketchthemes.com
*/
class BizoHoursSettingPage
{
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'bizohours_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'bizohours_page_init' ) );
	}

	/**
	 * Add plugin page
	 */
	public function bizohours_plugin_page()
	{
		// This page will be in "Dashboard Menu"
		add_menu_page(
			__('Settings Admin', 'bizo-hours'), 
			__('Business Hours', 'bizo-hours'), 
			'manage_options', 
			'bizohours-setting-admin', 
			array( $this, 'bizohours_admin_page' ),
			plugins_url( 'images/icon.png',__FILE__)
		);
	}

	/**
	 * Plugin page callback
	 */
	public function bizohours_admin_page()
	{
		// Set class property
		$this->options = get_option( 'bizohours_options' );
?>
		<div class="wrap">
			<h2><?php _e('Business Hours Settings', 'bizo-hours'); ?></h2>
			<!-- WP-Banner Starts Here -->
			<div id="wp_banner" class="nbar-lite">
				<!-- Top Section Starts Here -->
				<div class="top_section">
					<!-- Begin MailChimp Signup Form -->
					<link type="text/css" rel="stylesheet" href="http://cdn-images.mailchimp.com/embedcode/classic-081711.css">
					<style type="text/css">
						#mc_embed_signup{ clear:left; font:14px Helvetica,Arial,sans-serif; }
						/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
						   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
					</style>
					<div id="mc_embed_signup">
						<form novalidate="" target="_blank" class="validate" name="mc-embedded-subscribe-form" id="mc-embedded-subscribe-form" method="post" action="http://wpfruits.us6.list-manage.com/subscribe/post?u=166c9fed36fb93e9202b68dc3&amp;id=bea82345ae">
							<div class="mc-field-group">
								<input type="email" id="mce-EMAIL" class="required email" name="EMAIL" value="" placeholder="Our Newsletter Just Enter Your Email Here" />
								<input type="submit" class="button" id="mc-embedded-subscribe" name="subscribe" value="" onclick="return nbar_wp_jsvalid();">
								<div style="clear:both;"></div>
							</div>
							<div class="clear" id="mce-responses">
								<div style="display:none" id="mce-error-response" class="response"></div>
								<div style="display:none" id="mce-success-response" class="response"></div>
							</div>	
							
						</form>
					</div>
					<script type="text/javascript">
						var fnames = new Array();var ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';
						try {
							var jqueryLoaded=jQuery;
							jqueryLoaded=true;
						} catch(err) {
							var jqueryLoaded=false;
						}
						var head= document.getElementsByTagName('head')[0];
						if (!jqueryLoaded) {
							var script = document.createElement('script');
							script.type = 'text/javascript';
							script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js';
							head.appendChild(script);
							if (script.readyState &amp;&amp; script.onload!==null){
								script.onreadystatechange= function () {
									  if (this.readyState == 'complete') mce_preload_check();
								}    
							}
						}
						var script = document.createElement('script');
						script.type = 'text/javascript';
						script.src = 'http://downloads.mailchimp.com/js/jquery.form-n-validate.js';
						head.appendChild(script);
						var err_style = '';
						try{
							err_style = mc_custom_error_style;
						} catch(e){
							err_style = '#mc_embed_signup input.mce_inline_error{border-color:#6B0505;} #mc_embed_signup div.mce_inline_error{margin: 0 0 1em 0; padding: 5px 10px; background-color:#6B0505; font-weight: bold; z-index: 1; color:#fff;}';
						}
						var head= document.getElementsByTagName('head')[0];
						var style= document.createElement('style');
						style.type= 'text/css';
						if (style.styleSheet) {
							style.styleSheet.cssText = err_style;
						} else {
							style.appendChild(document.createTextNode(err_style));
						}
						head.appendChild(style);
						setTimeout('mce_preload_check();', 250);

						var mce_preload_checks = 0;
						function mce_preload_check(){
							if (mce_preload_checks&gt;40) return;
							mce_preload_checks++;
							try {
								var jqueryLoaded=jQuery;
							} catch(err) {
								setTimeout('mce_preload_check();', 250);
								return;
							}
							try {
								var validatorLoaded=jQuery("#fake-form").validate({});
							} catch(err) {
								setTimeout('mce_preload_check();', 250);
								return;
							}
							mce_init_form();
						}
						function mce_init_form()
						{
							jQuery(document).ready( function($) 
							{
							  var options = { errorClass: 'mce_inline_error', errorElement: 'div', onkeyup: function(){}, onfocusout:function(){}, onblur:function(){}  };
							  var mce_validator = $("#mc-embedded-subscribe-form").validate(options);
							  $("#mc-embedded-subscribe-form").unbind('submit');//remove the validator so we can get into beforeSubmit on the ajaxform, which then calls the validator
							  options = { url: 'http://wpfruits.us6.list-manage.com/subscribe/post-json?u=166c9fed36fb93e9202b68dc3&amp;id=bea82345ae&amp;c=?', type: 'GET', dataType: 'json', contentType: "application/json; charset=utf-8",
											beforeSubmit: function(){
												$('#mce_tmp_error_msg').remove();
												$('.datefield','#mc_embed_signup').each(
													function(){
														var txt = 'filled';
														var fields = new Array();
														var i = 0;
														$(':text', this).each(
															function(){
																fields[i] = this;
																i++;
															});
														$(':hidden', this).each(
															function(){
																var bday = false;
																if (fields.length == 2){
																	bday = true;
																	fields[2] = {'value':1970};//trick birthdays into having years
																}
																if ( fields[0].value=='MM' &amp;&amp; fields[1].value=='DD' &amp;&amp; (fields[2].value=='YYYY' || (bday &amp;&amp; fields[2].value==1970) ) ){
																	this.value = '';
																} else if ( fields[0].value=='' &amp;&amp; fields[1].value=='' &amp;&amp; (fields[2].value=='' || (bday &amp;&amp; fields[2].value==1970) ) ){
																	this.value = '';
																} else {
																	if (/\[day\]/.test(fields[0].name)){
																		this.value = fields[1].value+'/'+fields[0].value+'/'+fields[2].value;									        
																	} else {
																		this.value = fields[0].value+'/'+fields[1].value+'/'+fields[2].value;
																	}
																}
															});
													});
												return mce_validator.form();
											}, 
											success: mce_success_cb
										};
							  $('#mc-embedded-subscribe-form').ajaxForm(options);

							});
						}
						function mce_success_cb(resp){
							$('#mce-success-response').hide();
							$('#mce-error-response').hide();
							if (resp.result=="success"){
								$('#mce-'+resp.result+'-response').show();
								$('#mce-'+resp.result+'-response').html(resp.msg);
								$('#mc-embedded-subscribe-form').each(function(){
									this.reset();
								});
							} else {
								var index = -1;
								var msg;
								try {
									var parts = resp.msg.split(' - ',2);
									if (parts[1]==undefined){
										msg = resp.msg;
									} else {
										i = parseInt(parts[0]);
										if (i.toString() == parts[0]){
											index = parts[0];
											msg = parts[1];
										} else {
											index = -1;
											msg = resp.msg;
										}
									}
								} catch(e){
									index = -1;
									msg = resp.msg;
								}
								try{
									if (index== -1){
										$('#mce-'+resp.result+'-response').show();
										$('#mce-'+resp.result+'-response').html(msg);            
									} else {
										err_id = 'mce_tmp_error_msg';
										html = '&lt;div id="'+err_id+'" style="'+err_style+'"&gt; '+msg+'&lt;/div&gt;';
										
										var input_id = '#mc_embed_signup';
										var f = $(input_id);
										if (ftypes[index]=='address'){
											input_id = '#mce-'+fnames[index]+'-addr1';
											f = $(input_id).parent().parent().get(0);
										} else if (ftypes[index]=='date'){
											input_id = '#mce-'+fnames[index]+'-month';
											f = $(input_id).parent().parent().get(0);
										} else {
											input_id = '#mce-'+fnames[index];
											f = $().parent(input_id).get(0);
										}
										if (f){
											$(f).append(html);
											$(input_id).focus();
										} else {
											$('#mce-'+resp.result+'-response').show();
											$('#mce-'+resp.result+'-response').html(msg);
										}
									}
								} catch(e){
									$('#mce-'+resp.result+'-response').show();
									$('#mce-'+resp.result+'-response').html(msg);
								}
							}
						}

					</script>
					<!--End mc_embed_signup-->
				</div>
				<!-- Top Section Ends Here -->
				
				<!-- Bottom Section Starts Here -->
				<div class="bot_section">
					<a href="http://www.wpfruits.com/" class="wplogo" target="_blank" title="WFruits.com"></a>
					<a href="https://www.facebook.com/pages/WPFruitscom/443589065662507" class="fbicon" target="_blank" title="Facebook"></a>
					<a href="http://www.twitter.com/wpfruits" class="twicon" target="_blank" title="Twitter"></a>
					<div style="clear:both;"></div>
				</div>
				<!-- Bottom Section Ends Here -->
			</div>
			<!-- WP-Banner Ends Here -->
			<div id="bizoh_setting">
			<form method="post" action="options.php">
			<?php
				// This printts out all hidden setting fields          
				settings_fields( 'bizohours_option_group' );   
				do_settings_sections( 'bizohours-setting-admin' );
				?>
				<hr/>
				<?php
				submit_button();
			?>
			</form>
			</div>
			<iframe class="bizoh_iframe" src="http://www.sketchthemes.com/sketch-updates/plugin-updates/nbar-lite/nbar-lite.php" width="250px" height="370px" scrolling="no" ></iframe> 
		</div>
<?php
	}

	/**
	 * Register and add settings
	 */
	public function bizohours_page_init()
	{
		register_setting(
			'bizohours_option_group', // Option group
			'bizohours_options', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'setting_section_id', // ID
			'', // Title
			array( $this, 'bizohours_print_section_info' ), // Callback
			'bizohours-setting-admin' // Page
		);  

		add_settings_field(
			'time_zone', // ID
			__('Select Timezone','bizo-hours'), // Title 
			array( $this, 'bizohours_time_zone_callback' ), // Callback
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section           
		);

		add_settings_field(
			'time_format', // ID
			__('Time Format','bizo-hours'), // Title 
			array( $this, 'bizohours_time_format_callback' ), // Callback
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section           
		);

		add_settings_field(
			'monday', // ID
			__('Monday','bizo-hours'), // Title 
			array( $this, 'bizohours_monday_callback' ), // Callback
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section           
		);    

		add_settings_field(
			'tuesday', // ID
			__('Tuesday','bizo-hours'), // Title
			array( $this, 'bizohours_tuesday_callback' ), // Callback
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'wednesday', // ID
			__('Wednesday','bizo-hours'), // Title
			array( $this, 'bizohours_wednesday_callback' ), // Callback
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'thursday', // ID
			__('Thursday','bizo-hours'), // Title
			array( $this, 'bizohours_thursday_callback' ), // Callback 
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'friday', // ID
			__('Friday','bizo-hours'), // Title
			array( $this, 'bizohours_friday_callback' ), // Callback
			'bizohours-setting-admin', // Page
			'setting_section_id' //Section
		);

		add_settings_field(
			'saturday', // ID
			__('Saturday','bizo-hours'), // Title
			array( $this, 'bizohours_saturday_callback' ), // Callback
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'sunday', // ID
			__('Sunday','bizo-hours'), // Title
			array( $this, 'bizohours_sunday_callback' ), // Callback 
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section
		);


		add_settings_field(
			'highlight_color', // ID
			__('Highlight Current Day','bizo-hours'), // Title
			array( $this, 'bizohours_highlight_bgcolor_callback' ), // Callback 
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'highlight_font_color', // ID
			'', // Title
			array( $this, 'bizohours_highlight_color_callback' ), // Callback 
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'genrated_shortcode', // ID
			__('Genrated Shortcode','bizo-hours'), // Title
			array( $this, 'bizohours_genrated_shortcode_callback' ), // Callback 
			'bizohours-setting-admin', // Page
			'setting_section_id' // Section
		);
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input )
	{
		$new_input = array();

		if( isset( $input['timeformat'] ) )
			$new_input['timeformat'] = sanitize_text_field( $input['timeformat'] );

		if( isset( $input['timezone'] ) )
			$new_input['timezone'] = sanitize_text_field( $input['timezone'] );

		if( isset( $input['mondayfrom'] ) )
			$new_input['mondayfrom'] = sanitize_text_field( $input['mondayfrom'] );
		if( isset( $input['mondayto'] ) )
			$new_input['mondayto'] = sanitize_text_field( $input['mondayto'] );
		    
		if( isset( $input['tuesdayfrom'] ) )
			$new_input['tuesdayfrom'] = sanitize_text_field( $input['tuesdayfrom'] );
		if( isset( $input['tuesdayto'] ) )
			$new_input['tuesdayto'] = sanitize_text_field( $input['tuesdayto'] );

		if( isset( $input['wednesdayfrom'] ) )
			$new_input['wednesdayfrom'] = sanitize_text_field( $input['wednesdayfrom'] );
		if( isset( $input['wednesdayto'] ) )
			$new_input['wednesdayto'] = sanitize_text_field( $input['wednesdayto'] );

		if( isset( $input['thursdayfrom'] ) )
			$new_input['thursdayfrom'] = sanitize_text_field( $input['thursdayfrom'] );
		if( isset( $input['thursdayto'] ) )
			$new_input['thursdayto'] = sanitize_text_field( $input['thursdayto'] );

		if( isset( $input['fridayfrom'] ) )
			$new_input['fridayfrom'] = sanitize_text_field( $input['fridayfrom'] );
		if( isset( $input['fridayto'] ) )
			$new_input['fridayto'] = sanitize_text_field( $input['fridayto'] );

		if( isset( $input['saturdayfrom'] ) )
			$new_input['saturdayfrom'] = sanitize_text_field( $input['saturdayfrom'] );
		if( isset( $input['saturdayto'] ) )
			$new_input['saturdayto'] = sanitize_text_field( $input['saturdayto'] );

		if( isset( $input['sundayfrom'] ) )
			$new_input['sundayfrom'] = sanitize_text_field( $input['sundayfrom'] );
		if( isset( $input['sundayto'] ) )
			$new_input['sundayto'] = sanitize_text_field( $input['sundayto'] );

		if( isset( $input['bizohbgcolor'] ) )
			$new_input['bizohbgcolor'] = sanitize_text_field( $input['bizohbgcolor'] );

		if( isset( $input['bizohfontcolor'] ) )
			$new_input['bizohfontcolor'] = sanitize_text_field( $input['bizohfontcolor'] );

		return $new_input;
	}

	/** 
	 * Print the Section text
	 */
	public function bizohours_print_section_info()
	{
		_e('<div id="bizohour-setting-note"><p><br/>The saved settings will work in the Business Hours Widget.You can also use Genrated Shortcode in the page or post.</p></div><hr/>', 'bizo-hours' );
	}

	/** 
	 * Get the settings option array and print one of its values
	 */

	public function bizohours_time_zone_callback()
	{
		$bizohours_options = get_option( "bizohours_options" );
		$timezone = $bizohours_options["timezone"];
		if(empty($timezone))
			$timezone = 'UTC';
		$date = new DateTime('now', new DateTimeZone($timezone));
		$localtime = $date->format('h:i:s a');
		echo '<select id="timezone" name="bizohours_options[timezone]">'.wp_timezone_choice($timezone).'</select><br>';
		echo "Local time is $localtime.";

	}

	public function bizohours_time_format_callback()
	{
		$bizohours_options = get_option( "bizohours_options" );
		
		echo '<select id="timeformat" name="bizohours_options[timeformat]"><option value="12 hours"';
			if($bizohours_options["timeformat"]=="12 hours") { echo 'selected'; }
			echo '>12 hours</option><option value="24 hours"';
			if($bizohours_options["timeformat"]=="24 hours") { echo 'selected'; }
			echo '>24 hours</option>
		</select>';
	}

	public function bizohours_monday_callback()
	{
		printf(
			'<input type="text" id="mondayfrom" class="bizoh-input" name="bizohours_options[mondayfrom]" value="%s" />
			 <input type="text" id="mondayto" class="bizoh-input" name="bizohours_options[mondayto]" value="%s" />',
			isset( $this->options['mondayfrom'] ) ? esc_attr( $this->options['mondayfrom']) : '',
			isset( $this->options['mondayto'] ) ? esc_attr( $this->options['mondayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function bizohours_tuesday_callback()
	{
		printf(
			'<input type="text" id="tuesdayfrom" class="bizoh-input" name="bizohours_options[tuesdayfrom]" value="%s" />
			 <input type="text" id="tuesdayto" class="bizoh-input" name="bizohours_options[tuesdayto]" value="%s" />',
			isset( $this->options['tuesdayfrom'] ) ? esc_attr( $this->options['tuesdayfrom']) : '',
			isset( $this->options['tuesdayto'] ) ? esc_attr( $this->options['tuesdayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function bizohours_wednesday_callback()
	{
		printf(
			'<input type="text" id="wednesdayfrom" class="bizoh-input" name="bizohours_options[wednesdayfrom]" value="%s" />
			 <input type="text" id="wednesdayto" class="bizoh-input" name="bizohours_options[wednesdayto]" value="%s" />',
			isset( $this->options['wednesdayfrom'] ) ? esc_attr( $this->options['wednesdayfrom']) : '',
			isset( $this->options['wednesdayto'] ) ? esc_attr( $this->options['wednesdayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function bizohours_thursday_callback()
	{
		printf(
			'<input type="text" id="thursdayfrom" class="bizoh-input" name="bizohours_options[thursdayfrom]" value="%s" />
			 <input type="text" id="thursdayto" class="bizoh-input" name="bizohours_options[thursdayto]" value="%s" />',
			isset( $this->options['thursdayfrom'] ) ? esc_attr( $this->options['thursdayfrom']) : '',
			isset( $this->options['thursdayto'] ) ? esc_attr( $this->options['thursdayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function bizohours_friday_callback()
	{
		printf(
			'<input type="text" id="fridayfrom" class="bizoh-input" name="bizohours_options[fridayfrom]" value="%s" />
			 <input type="text" id="fridayto" class="bizoh-input" name="bizohours_options[fridayto]" value="%s" />',
			isset( $this->options['fridayfrom'] ) ? esc_attr( $this->options['fridayfrom']) : '',
			isset( $this->options['fridayto'] ) ? esc_attr( $this->options['fridayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function bizohours_saturday_callback()
	{
		printf(
			'<input type="text" id="saturdayfrom" class="bizoh-input" name="bizohours_options[saturdayfrom]" value="%s" />
			 <input type="text" id="saturdayto" class="bizoh-input" name="bizohours_options[saturdayto]" value="%s" />',
			isset( $this->options['saturdayfrom'] ) ? esc_attr( $this->options['saturdayfrom']) : '',
			isset( $this->options['saturdayto'] ) ? esc_attr( $this->options['saturdayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function bizohours_sunday_callback()
	{
		printf(
			'<input type="text" id="sundayfrom" class="bizoh-input" name="bizohours_options[sundayfrom]" value="%s" />
			 <input type="text" id="sundayto" class="bizoh-input" name="bizohours_options[sundayto]" value="%s" />',
			isset( $this->options['sundayfrom'] ) ? esc_attr( $this->options['sundayfrom']) : '',
			isset( $this->options['sundayto'] ) ? esc_attr( $this->options['sundayto']) : ''
		);
	}

	/** 
	 * Get the settings option array and print one of its values
	 */
	public function bizohours_genrated_shortcode_callback()
	{
		echo '<textarea id="genrated-shortcode" onclick="this.focus();this.select()" name="genrated-shortcode" rows="8" cols="50" readonly></textarea>
			<p id="boh-message">Copy and Paste above shortcode. You can change title attribute as you wish.</p>';
	}

	public function bizohours_highlight_bgcolor_callback()
	{
		printf('<p><label>Select Background Color&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></p><p><input type="text" id="bizohbgcolor" name="bizohours_options[bizohbgcolor]" value="%s" class="bizoh-highlight-color" data-default-color="#000000" /></p>',
			isset( $this->options['bizohbgcolor'] ) ? esc_attr( $this->options['bizohbgcolor']) : '#000000'
		);
	}

	public function bizohours_highlight_color_callback()
	{
		printf('<p><label>Select Font Color&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></p><p><input type="text" id="bizohfontcolor" name="bizohours_options[bizohfontcolor]" value="%s" class="bizoh-highlight-font-color" data-default-color="#ffffff" /></p>',
			isset( $this->options['bizohfontcolor'] ) ? esc_attr( $this->options['bizohfontcolor']) : '#ffffff'
		);
	}
}

/**** Instantiate Class ****/
if( is_admin() )
	$bizohours_settings_page = new BizoHoursSettingPage();

/**** Include Front Style ****/
function bizohours_front_styles() {
	wp_enqueue_script('jquery');
	echo '<script type="text/javascript">
	jQuery(document).ready(function() {
	"use strict";
		jQuery("tr:contains(Close)").css("color", "#ff0000");
	});	
	</script>';	
	wp_enqueue_style('bizohours-style-front', plugins_url('css/bizo-hours.css',__FILE__), false, '1.0.0' );
}
add_action( 'wp_footer', 'bizohours_front_styles' );

/**** Include Admin Style ****/
function bizohours_admin_style() {
	wp_enqueue_script('jquery');
	// Color Picker JS
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );
	// Timepicker JS
	wp_enqueue_script('bizohours-timepicker-js', plugins_url('js/jquery.timepicker.min.js',__FILE__), true );
	// Admin Custom CSS
	wp_enqueue_style('bizohours-admin-style', plugins_url('css/bizo-hours-admin.css',__FILE__), false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'bizohours_admin_style' );

function bizohours_admin_custom_script() {
	
	if(isset($_REQUEST['page']) && $_REQUEST['page']=="bizohours-setting-admin")
		include('js/admin-custom-js.php'); // Admin Custom JS
}
add_action( 'wp_before_admin_bar_render', 'bizohours_admin_custom_script' );

/**** Include Business Hours Widget ****/
include ('bizo-hours-widget.php');
include ('bizo-hours-shortcode.php');

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function bizohours_load_textdomain() {
  load_plugin_textdomain( 'bizo-hours', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'bizohours_load_textdomain' );

?>
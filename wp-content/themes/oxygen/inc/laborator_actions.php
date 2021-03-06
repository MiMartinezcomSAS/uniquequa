<?php
/**
 *	Oxygen WordPress Theme
 *	
 *	Laborator.co
 *	www.laborator.co 
 */


# Base Functionality 
function laborator_init()
{
	# Styles
	wp_register_style('oxygen-admin', THEMEASSETS . 'css/admin.css', null, null);
	wp_register_style('boostrap', THEMEASSETS . 'css/bootstrap.css', null, null);
	wp_register_style('oxygen-main', THEMEASSETS . 'css/oxygen.css', null, null);
	wp_register_style('style', get_template_directory_uri() . '/style.css', null, null);
	wp_register_style('oxygen-responsive', THEMEASSETS . 'css/responsive.css', null, null);
	wp_register_style('entypo', THEMEASSETS . 'fonts/entypo/css/fontello.css', null, null);
	
	wp_register_style('custom-skin', THEMEASSETS . 'css/skin.css', null, null);
	
	# Scripts
	wp_register_script('bootstrap', THEMEASSETS . 'js/bootstrap.min.js', null, null, true);
	wp_register_script('bootstrap-slider', THEMEASSETS . 'js/bootstrap-slider.js', null, null, true);
	wp_register_script('joinable', THEMEASSETS . 'js/joinable.js', null, null, true);
	wp_register_script('resizable', THEMEASSETS . 'js/resizable.js', null, null, true);
	wp_register_script('oxygen-contact', THEMEASSETS . 'js/oxygen-contact.js', null, null, true);
	wp_register_script('oxygen-custom', THEMEASSETS . 'js/oxygen-custom.js', null, null, true);
	wp_register_script('gsap-tweenlite', THEMEASSETS . 'js/TweenMax.min.js', null, null, true);
	wp_register_script('google-map', '//maps.google.com/maps/api/js?sensor=false&libraries=geometry', null, null);
	
	
		# Nivo Lightbox
		wp_register_script('nivo-lightbox', THEMEASSETS . 'js/nivo-lightbox/nivo-lightbox.min.js', null, null, true);
		wp_register_style('nivo-lightbox', THEMEASSETS . 'js/nivo-lightbox/nivo-lightbox.css', null, null);
		wp_register_style('nivo-lightbox-default', THEMEASSETS . 'js/nivo-lightbox/themes/default/default.css', null, null);
		
		# iCheck
		wp_register_script('icheck', THEMEASSETS . 'js/icheck/icheck.min.js', null, null, true);
		wp_register_style('icheck', THEMEASSETS . 'js/icheck/oxygen.css', null, null);
		
		# Owl Carousel
		wp_register_script('owl-carousel', THEMEASSETS . 'js/owl-carousel/owl.carousel.min.js', null, null, true);
		wp_register_style('owl-carousel', THEMEASSETS . 'js/owl-carousel/owl.carousel.css', null, null);
		wp_register_style('owl-carousel-theme', THEMEASSETS . 'js/owl-carousel/owl.theme.css', array('owl-carousel'), null);
		
		# CBP Gallery
		wp_register_script('cbp-modernizr', THEMEASSETS . 'js/cbp-grid-gallery/modernizr.custom.js', null, null, true);
		wp_register_script('cbp-grid-gallery', THEMEASSETS . 'js/cbp-grid-gallery/cbp-grid-gallery.js', array('cbp-modernizr'), null, true);
		wp_register_style('cbp-grid-gallery', THEMEASSETS . 'js/cbp-grid-gallery/cbp-grid-gallery.css', null, null);
		
		# Cycle2
		wp_register_script('cycle2', THEMEASSETS . 'js/jquery.cycle2.min.js', null, null, true);

				
	# Revolution Slider Activate
	if(function_exists('putRevSlider'))
	{
		if(get_option('revslider-valid', 'false') == 'false')
		{
			update_option('revslider-valid', 'true');
		}
	}
}


# After Setup Theme
function laborator_after_setup_theme()
{
	# Theme Support
	add_theme_support('menus');
	add_theme_support('widgets');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_theme_support('featured-image');
	add_theme_support('woocommerce');


	# Theme Textdomain
	load_theme_textdomain(TD, get_template_directory() . '/languages');
	
	
	# Register Menus
	register_nav_menus(
		array(
			'main-menu' => 'Main Menu',
			'top-menu' => 'Top Menu',
			'footer-menu' => 'Footer Menu'
		)
	);
	

	# Header Type Constant
	$header_type = get_data('header_type');
	
	if($header_type == '2-gray')
	{
		define("GRAY_MENU", 1);
		$header_type = 2;
	}
	
	define("HEADER_TYPE", $header_type);
	

	# Gallery Boxes
	new GalleryBox('post_slider_images', array('title' => 'Post Slider Images', 'post_types' => array('post')));
}


# Widgets Init
function laborator_widgets_init()
{
	# Blog Sidebar
	$blog_sidebar = array(
		'id' => 'blog_sidebar',
		'name' => 'Blog Sidebar',
		
		'before_widget' => '<div class="sidebar %2$s %1$s">',
		'after_widget' => '</div>',
		
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	);
	
	register_sidebar($blog_sidebar);
	
	
	# Footer Sidebar
	$footer_sidebar_columns = 4;
	
	switch(get_data('footer_widgets_columns'))
	{
		case "[1/2] Two Columns":
			$footer_sidebar_columns = 6;
			break;
			
		case "[1/4] Four Columns":
			$footer_sidebar_columns = 3;
			break;
			
		case "[1/6] Two Columns":
			$footer_sidebar_columns = 2;
			break;
	}
	
	$footer_sidebar = array(
		'id' => 'footer_sidebar',
		'name' => 'Footer Sidebar',
		
		'before_widget' => '<div class="col-sm-'. $footer_sidebar_columns .'"><div class="footer-block %2$s %1$s">',
		'after_widget' => '</div></div>',
		
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	);
	
	register_sidebar($footer_sidebar);
	
	
	if( ! in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
		return;
	
	# Shop Sidebar
	$shop_sidebar = array(
		'id' => 'shop_sidebar',
		'name' => 'Shop Sidebar',
		
		'before_widget' => '<div class="sidebar %2$s %1$s">',
		'after_widget' => '</div>',
		
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	);
	
	register_sidebar($shop_sidebar);
	
	
	# Shop Footer Sidebar
	$shop_footer_sidebar_colums = 'col-sm-3';
	
	switch(get_data('shop_sidebar_footer_columns'))
	{
		case "2":
			$shop_footer_sidebar_colums = 'col-sm-6';
			break;
			
		case "3":
			$shop_footer_sidebar_colums = 'col-sm-4';
			break;
	}
	
	$shop_footer_sidebar = array(
		'id' => 'shop_footer_sidebar',
		'name' => 'Shop Footer Sidebar',
		
		'before_widget' => '<div class="'. $shop_footer_sidebar_colums .'"><div class="sidebar %2$s %1$s">',
		'after_widget' => '</div></div>',
		
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	);
	
	register_sidebar($shop_footer_sidebar);
}


# Enqueue Scritps and Stuff like that
function laborator_wp_enqueue_scripts()
{
	# Styles
	wp_enqueue_style(array('boostrap', 'oxygen-main', 'oxygen-responsive', 'entypo', 'style'));
	
		# Custom Skin
		$use_skin_type = get_data('use_skin_type');
		$use_custom_skin = get_data('use_custom_skin');
		
		if($use_custom_skin)
		{
			wp_enqueue_style('custom-style', THEMEASSETS . 'css/custom-skin.css');
		}
		else
		if(preg_match("/([a-z0-9-]+)\.png$/", $use_skin_type, $matched_skin))
		{
			$registered_skins = array(
				'skin-type-2' => 'blue',
				'skin-type-3' => 'green',
				'skin-type-4' => 'ocean',
				'skin-type-5' => 'orange',
				'skin-type-6' => 'pink',
				'skin-type-7' => 'purple',
				'skin-type-8' => 'turquoise',
			);
			
			if(isset($registered_skins[$matched_skin[1]]))
			{
				$style_name = $registered_skins[$matched_skin[1]];
				
				wp_enqueue_style('style-' . $style_name, THEMEASSETS . 'css/skins/' . $style_name . '.css');
			}
		}
		#wp_enqueue_style('custom-skin');
	
	# Scripts
	wp_enqueue_script(array('jquery', 'bootstrap', 'gsap-tweenlite', 'joinable', 'resizable'));
}


function laborator_wp_print_scripts()
{
?>
<script type="text/javascript">
var ajaxurl = ajaxurl || '<?php echo esc_attr( admin_url("admin-ajax.php") ); ?>';
</script>
<?php
}


function laborator_wp_head()
{
	laborator_load_font_style();
	
	# Added in v1.2
	$custom_css_general        = get_data('custom_css_general');
	$custom_css_general_lg     = get_data('custom_css_general_lg');
	$custom_css_general_md     = get_data('custom_css_general_md');
	$custom_css_general_sm     = get_data('custom_css_general_sm');
	$custom_css_general_xs     = get_data('custom_css_general_xs');
	$custom_css_general_xxs    = get_data('custom_css_general_xxs');
	
	$custom_css = '<style>';
	
	if($custom_css_general)
		$custom_css .= PHP_EOL . $custom_css_general . PHP_EOL;
	
		
	if($custom_css_general_md)
		$custom_css .= PHP_EOL . '@media screen and (min-width:992px){ ' . PHP_EOL . $custom_css_general_md . PHP_EOL . '}' . PHP_EOL;	
	
	if($custom_css_general_lg)
		$custom_css .= PHP_EOL . '@media screen and (min-width:1200px){ ' . PHP_EOL . $custom_css_general_lg . PHP_EOL . '}' . PHP_EOL;
		
	if($custom_css_general_sm)
		$custom_css .= PHP_EOL . '@media screen and (min-width:768px) and (max-width:991px){ ' . PHP_EOL . $custom_css_general_sm . PHP_EOL . '}' . PHP_EOL;
		
	if($custom_css_general_xs)
		$custom_css .= PHP_EOL . '@media screen and (min-width:480px) and (max-width:767px){ ' . PHP_EOL . $custom_css_general_xs . PHP_EOL . '}' . PHP_EOL;
		
	if($custom_css_general_xxs)
		$custom_css .= PHP_EOL . '@media screen and (max-width:479px){ ' . PHP_EOL . $custom_css_general_xxs . PHP_EOL . '}' . PHP_EOL;
	
	$custom_css .= '</style>';
	
	if($custom_css != '<style></style>')
	{
		echo compress_text($custom_css);
	}
	# End: Added in v1.2
	
?>
<!--[if lt IE 9]><script src="<?php echo THEMEASSETS; ?>js/ie8-responsive-file-warning.js"></script><![endif]-->

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<?php
}


function laborator_wp_footer()
{
	# Custom.js
	wp_enqueue_script('oxygen-custom');
	
	# Tracking Code
	echo get_data('google_analytics');

	# Page Generation Speed
	#echo '<!-- Generated in ' . (microtime(true) - STIME) . ' seconds -->';
}


function laborator_admin_print_styles()
{
?>
<style>
	
#toplevel_page_laborator_options .wp-menu-image {
	background: url(<?php echo get_template_directory_uri(); ?>/assets/images/laborator-icon-adminmenu16-sprite.png) no-repeat 11px 8px !important;
}

#toplevel_page_laborator_options .wp-menu-image:before {
	display: none;
}

#toplevel_page_laborator_options .wp-menu-image img {
	display: none;
}

#toplevel_page_laborator_options:hover .wp-menu-image, #toplevel_page_laborator_options.wp-has-current-submenu .wp-menu-image {
	background-position: 11px -24px !important;
}

</style>
<?php
}


# Laborator Menu Page
function laborator_menu_page()
{
	add_menu_page('Laborator', 'Laborator', 'edit_theme_options', 'laborator_options', 'laborator_main_page');
	
	if(get('page') == 'laborator_options')
	{
		wp_redirect( admin_url('themes.php?page=theme-options') );
	}
}

function laborator_main_page()
{
	?>
	<div class="wrap">Redirecting...</div>
	<?php
	?><script type="text/javascript"> window.location = '<?php echo admin_url('themes.php?page=theme-options'); ?>'; </script><?php
}


# Redirect to Theme Options
function laborator_options()
{
	wp_redirect( admin_url('themes.php?page=theme-options') );
}


# Documentation Page iFrame
function laborator_menu_documentation()
{
	add_submenu_page('laborator_options', 'Documentation', 'Help', 'edit_theme_options', 'laborator_docs', 'laborator_documentation_page');
}

function laborator_documentation_page()
{
	add_thickbox();
?>
<div class="wrap">
	<h2>Documentation</h2>
	
	<p>You can read full theme documentation by clicking the button below:</p>
	
	<p>
		<a href="http://documentation.laborator.co/oxygen" class="button button-primary" id="lab_read_docs">Read Documentation</a>
	</p>
	
	
	<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#lab_read_docs").click(function(ev)
		{
			ev.preventDefault();
			
			var href = $(this).attr('href');
			
			tb_show('Theme Documentation' , href + '?TB_iframe=1&width=1024&height=568');
		});
	});
	</script>
	
	<style>
		.lab-faq-links {
			
		}
		
		.lab-faq-links li {
			margin-top: 18px;
			background: #FFF;
			border: 1px solid #E0E0E0;
			padding: 0;
		}
		
		.lab-faq-links li > strong {
			display: block;
			padding: 10px 15px;
			background: rgba(238,238,238,0.6);
		}
		
		.lab-faq-links li pre {
			font-size: 13px;
			max-width: 100%;
			word-break: break-word;
			padding: 10px 15px;
			padding-top: 5px;
		}
		
		.lab-faq-links .warn {
			display: block;
			font-family: Arial, Helvetica, sans-serif;
			border: 1px solid #999;
			padding: 10px;
			font-size: 12px;
			text-transform: uppercase;
		}
	</style>
	
	<br />
	<h3>Frequently Asked Questions</h3>
	<hr />
	
	<ul class="lab-faq-links">
		<li>
			
			<strong>How do I update the theme?</strong>
			
			<pre>1. Go to Envato Toolkit link in the menu (firstly activate it on: Appearance > Install Plugins)

2. There you type your username i.e. <strong>MyEnvatoUsername</strong> and your <strong>Secret API Key</strong> that can be found on &quot;My Settings&quot; page on ThemeForest,
   example: <a href="http://cl.ly/WT2j" target="_blank">http://cl.ly/WT2j</a>

3. When new update its ready, you'll see a notification under <strong>Envato Toolkit</strong> link. From there you can update the theme.</pre>
		</li>
		
		<li>
			
			<strong>How to update Visual Composer (or any other plugin)?</strong>
			
			<pre>When new theme update is applied it happens often that external plugins needs to be updated too. 
This is an extra step you should take in order to keep some plugins up to date (not all necessarily).

To update a specific plugin, for this example we will take "Visual Composer" follow these steps:

1. Go to Plugins, find "WPBakery Visual Composer" plugin (relevant plugin you want to update).

2. Click "Deactivate", when page refreshes click "Delete" on the same plugin.

3. Go to <strong>Appearance > Install Plugins</strong>, find the Visual Composer (or relevant) plugin click Install then Activate.

4. Everything is done.

The same steps can be repeated for other plugins in the <strong>Install Plugins</strong> list.

<strong class="warn">Important Note: You don't have to buy these plugins, they are bundled with the theme</strong></pre>
		</li>
		
		<li>
			
			<strong>Regenerate Thumbnails</strong>
			
			<pre>If your thumbnails are not correctly cropped, you can regenerate them by following these steps:

1. Go to Plugins > Add New

2. Search for "<strong>Regenerate Thumbnails</strong>" (created by <strong>Viper007Bond</strong>)

3. Install and activate that plugin.

4. Go to Tools > Regen. Thumbnails

5. Click "Regenerate All Thumbnails" button and let the process to finish till it reaches 100 percent.</pre>
		</li>
	</ul>
</div>
<?php
}


# Admin Enqueue Only
function laborator_admin_enqueue_scripts()
{
	wp_enqueue_style('oxygen-admin');
}



# Register Theme Plugins
function oxygen_register_required_plugins()
{

	$plugins = array(

		array(
			'name'     				=> 'Advanced Custom Fields',
			'slug'     				=> 'advanced-custom-fields',
			'required' 				=> true,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> ''
		),

		array(
			'name'     				=> 'ACF Location Field (Add on)',
			'slug'     				=> 'advanced-custom-fields-location-field-add-on',
			'required' 				=> true,
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> ''
		),
		
		array(
			'name'                   => 'ACF Repeater Field (Add on)',
			'slug'                   => 'acf-repeater',
			'source'                 => THEMEDIR . 'inc/thirdparty-plugins/acf-repeater.zip',
			'required'               => false,
			'version'                => '',
			'force_activation'       => false,
			'force_deactivation'     => false,
		),
		
		array(
			'name'                   => 'Revolution Slider',
			'slug'                   => 'revslider',
			'source'                 => THEMEDIR . 'inc/thirdparty-plugins/revslider.zip',
			'required'               => false,
			'version'                => '',
			'force_activation'       => false,
			'force_deactivation'     => false,
		),
		
		array(
			'name'                   => 'WP Bakery Visual Composer',
			'slug'                   => 'js_composer',
			'source'                 => THEMEDIR . 'inc/thirdparty-plugins/js_composer.zip',
			'required'               => true,
			'version'                => '',
			'force_activation'       => false,
			'force_deactivation'     => false,
		),
		
		array(
			'name'                   => 'Envato WordPress Toolkit',
			'slug'                   => 'envato-wordpress-toolkit',
			'source'                 => THEMEDIR . 'inc/thirdparty-plugins/envato-wordpress-toolkit.zip',
			'required'               => false,
			'version'                => '',
			'force_activation'       => false,
			'force_deactivation'     => false,
		),
	);
	
	if(function_exists('WC'))
	{
		$plugins[] = array(
			'name'                   => 'YITH WooCommerce Wishlist',
			'slug'                   => 'yith-woocommerce-wishlist',
			'required'               => false,
			'version'                => '',
			'force_activation'       => false,
			'force_deactivation'     => false,
		);
	}

	$theme_text_domain = TD;
	
	$config = array(
		'domain'                              => $theme_text_domain, 
		'default_path'                        => '',
		'parent_menu_slug'                    => 'themes.php',
		'parent_url_slug'                     => 'themes.php',
		'menu'                                => 'install-required-plugins',
		'has_notices'                         => true,
		'is_automatic'                        => false,
		'message'                             => '',
		'strings'                             => array(
			'page_title'                         => __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                         => __( 'Install Plugins', $theme_text_domain ),
			'installing'                         => __( 'Installing Plugin: %s', $theme_text_domain ),
			'oops'                               => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'        => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
			'notice_can_install_recommended'     => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
			'notice_cannot_install'              => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
			'notice_can_activate_required'       => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
			'notice_can_activate_recommended'    => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), 
			'notice_cannot_activate'             => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
			'notice_ask_to_update'               => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
			'notice_cannot_update'               => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
			'install_link'                       => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link'                      => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                             => __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                   => __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete'                           => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), 
			'nag_type'                           => 'updated'
		)
	);

	tgmpa( $plugins, $config );
}


# Commenting Rules
function laborator_commenting_rules()
{
	?>
	<div class="row">
		<div class="col-lg-12">
		
			<div class="rules">
				<h4><?php _e('Rules of the Blog', TD); ?></h4>
				<p class="text-small"><?php _e('Do not post violating content, tags like bold, italic and underline are allowed that means HTML can be used while commenting.', TD); ?></p>
			</div>
		
		</div>
	</div>
	<?php
}


function laborator_comment_before_fields()
{
	echo '<div class="row">';
}


function laborator_comment_after_fields()
{
	echo '</div>';
}



# Ajax Contact Form
add_action('wp_ajax_cf_process', 'laborator_cf_process');
add_action('wp_ajax_nopriv_cf_process', 'laborator_cf_process');

function laborator_cf_process()
{
	$resp = array('success' => false);
	
	$verify	   = post('verify');
	
	$id        = post('id');
	$name      = post('name');
	$email     = post('email');
	$phone     = post('phone');
	$message   = post('message');

	$field_names = array(
		'name'    => __('Name', TD),
		'email'   => __('E-mail', TD),
		'phone'   => __('Phone Number', TD),
		'message' => __('Message', TD),
	);
	
	$resp['re'] = $verify;
	
	if(wp_verify_nonce($verify, 'contact-form'))
	{
		$admin_email = get_option('admin_email');
		$ip = $_SERVER['REMOTE_ADDR'];
		
		if($id)
		{
			$custom_receiver = get_post_meta($id, 'email_notifications', true);
			
			if(is_email($custom_receiver))
				$admin_email = $custom_receiver;
		}
		
		$email_subject = "[" . get_bloginfo("name") . "] New contact form message submitted.";
		$email_message = "New message has been submitted on your website contact form. IP Address: {$ip}\n\n=====\n\n";
		
		$fields = array('name', 'email', 'phone', 'message');
		
		foreach($fields as $key)
		{
			$val = post($key);
			
			$field_label = isset($field_names[$key]) ? $field_names[$key] : ucfirst($key);
			
			$email_message .= "{$field_label}:\n" . ($val ? $val : '/') . "\n\n";
		}
		
		$email_message .= "=====\n\nThis email has been automatically sent from Contact Form.";
		
		$headers = array();
		
		if($email)
		{
			$headers[] = "Reply-To: {$name} <{$email}>";
		}
		
		wp_mail($admin_email, $email_subject, $email_message, $headers);
		
		$resp['success'] = true;
	}
	
	echo json_encode($resp);
	exit;
}



# Calculate the route
add_action('wp_ajax_laborator_calc_route', 'laborator_calc_route');
add_action('wp_ajax_nopriv_laborator_calc_route', 'laborator_calc_route');

function laborator_calc_route()
{	
	$json_encoded = wp_remote_get(get('route_path'));
	$resp = json_decode(wp_remote_retrieve_body($json_encoded));
	
	echo json_encode($resp);
	exit;
}



# VC Theme Setup
add_action('init', 'laborator_vc_set_as_theme');

function laborator_vc_set_as_theme() 
{
	if(function_exists('vc_manager'))
	{
		vc_manager()->setAsNetworkPlugin(true);
	}
	
	if(function_exists('vc_set_as_theme'))
	{
		vc_set_as_theme(true);
	}
}



# Fav Icon 
function laborator_favicon()
{
	$favicon_image = get_data('favicon_image');
	$apple_touch_icon = get_data('apple_touch_icon');
	
	if($favicon_image || $apple_touch_icon)
	{
	?>
	<!-- Favicons -->
	<?php if($favicon_image): ?>
	<link rel="shortcut icon" href="<?php echo $favicon_image; ?>">
	<?php endif; ?>
	<?php if($apple_touch_icon): ?>
	<link rel="apple-touch-icon-precomposed" href="<?php echo $apple_touch_icon; ?>">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $apple_touch_icon; ?>">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $apple_touch_icon; ?>">
	<?php endif; ?>
	<?php
	}
}




# Testimonials Post type
function laborator_testimonials_postype()
{
	register_post_type( 'testimonial',
		array(
			'labels' => array(
				'name'          => __( 'Testimonials', TD),
				'singular_name' => __( 'Testimonial', TD)
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
			'menu_icon' => 'dashicons-testimonial'
		)
	);
}



# Setup Menu Location
function laborator_setup_menus_notice()
{
	if( ! isset($_GET['action']) || $_GET['action'] != 'locations')
	{
	?>
	<div class="updated">
		<p>
			<strong><?php _e( 'Warning:', TD); ?></strong>
			<?php _e('Please set up menu locations for this theme. <a href="'.admin_url("nav-menus.php?action=locations").'">Click here to go to menu location settings &raquo;</a>', TD); ?>
		</p>
	</div>
	<?php
	}
}
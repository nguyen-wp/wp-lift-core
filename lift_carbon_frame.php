<?php 

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function lift_admin_lift_img_error() {
	// MASS RENAME IMG 
	$query_images_args = array(
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'post_status'    => 'inherit',
		'posts_per_page' => -1,
	);
	$query_images = new WP_Query( $query_images_args );
	$images = array();
	foreach ( $query_images->posts as $image ) {
		$url = pathinfo(wp_get_attachment_url( $image->ID ));
		$old_file = $url['filename'];
		$old_rename = substr(parse_url(wp_get_attachment_url( $image->ID ), PHP_URL_PATH),1);
		$new_name = str_replace("_", "-", $old_file);
		$new_name = str_replace(".", "-", $new_name);
		$new_file_name = $url['dirname']. '/' . $new_name . '.'. $url['extension'];
		$new_file = pathinfo($old_rename)['dirname']. '/' . $new_name . '.'. $url['extension'];
		RenameImageAttach($old_rename, $new_file, $image->ID, $new_file_name ); 
	}
	header('Location: admin.php?page='. $_POST["return"].'');
}

function RenameImageAttach($old_rename, $new_name, $id, $new_file_name) {
	global $wpdb;
	try{
		@rename($_SERVER['DOCUMENT_ROOT'].'/'.$old_rename, $_SERVER['DOCUMENT_ROOT'].'/'.$new_name );
	}catch (\Exception $e) {
	} finally {
		$wpdb->update($wpdb->posts, ['guid' => $new_file_name, 'post_title' => pathinfo($new_name)['filename']], ['ID' => $id]);
		@update_attached_file( $id, $new_file_name );
	}
}

function Lift_tabCleanUp() {
	$data = array();
	if (class_exists( 'LIFT_WP_CLEAN_MAIN' ) ) {
		$data = array(
			Field::make( 'html', 'crb_html_2', __( 'Section Description' ) )
				->set_html('Clean Up can help us to clean up the wordpress dashboard.'),
			Field::make( 'separator', 'crb_separator_1', __( 'Global' ) ),
			Field::make(
				'checkbox', 
				'___lift_disable_comments',
				__('Disable Comments on WordPress')
				)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_admin_bar',
					__('Remove Admin bar')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_admin_text',
					__('Remove label \'WordPress\' from the title bar')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_wp_logo',
					__('Remove WP Logo on Admin bar')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_help_menu',
					__('Remove Admin Help Menu')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_goto',
					__('Remove Go to link from Login page')
					)->set_option_value( 'yes' ),
				Field::make( 'separator', 'crb_separator_2', __( 'Dashboard' ) ),
				Field::make(
					'checkbox', 
					'___lift_remove_dashboard_quick_press',
					__('Remove Quick Draft on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_dashboard_primary',
					__('Remove Wordpress Events and News on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_yoast_db_widget',
					__('Remove Yoast SEO on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_dashboard_site_health',
					__('Remove Site Health on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_dashboard_activity',
					__('Remove Wordpress Activity on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_dashboard_right_now',
					__('Remove At a Glance on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_welcome_panel',
					__('Remove Welcome Panel on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_update_nag',
					__('Remove Admin Update on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_gutenberg_panel',
					__('Remove Gutenberg Panel on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_incoming_links',
					__('Remove Incoming links on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_plugins',
					__('Remove Plugins on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_secondary',
					__('Remove the secondary on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_recent_drafts',
					__('Remove Recent Drafts on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_recent_comments',
					__('Remove Recent Comments on Dashboard')
					)->set_option_value( 'yes' ),
				Field::make(
					'checkbox', 
					'___lift_remove_notice',
					__('Remove Wordpress Notifications')
					)->set_option_value( 'yes' ),
				Field::make(
					'textarea', 
					'___lift_remove_dashboardbyid',
					__('Remove Panel ID on Dashboard')
					)->set_rows(6)->set_attribute( 'placeholder', 'enter panel id and add comma (,) end of id. e.g: lift_home, lift_contact' ),
		);
	} else {
		$data = array(
			Field::make( 'html', 'crb_html_3', __( 'Section Description' ) )
				->set_html('Clean Up can help us to clean up the wordpress dashboard.'),
			Field::make( 'separator', 'crb_separator_1', __( 'Global' ) ),
			Field::make(
				'checkbox', 
				'___lift_disable_comments',
				__('Disable Comments on WordPress')
				)->set_option_value( 'yes' ),
		);
	}
	return $data;
}
function Lift_tabUpdates() {
	$data = array(
		Field::make( 'separator', 'crb_separator_4', __( 'Update' ) ),
		Field::make(
			'checkbox', 
			'___lift_remove_core_update',
			__('Disable Automatic Core update')
			)->set_option_value( 'yes' ),
		Field::make(
			'checkbox', 
			'___lift_remove_plugins_update',
			__('Disable Automatic Plugins update')
			)->set_option_value( 'yes' ),
		Field::make(
			'checkbox', 
			'___lift_remove_theme_update',
			__('Disable Automatic Themes update')
			)->set_option_value( 'yes' ),
		Field::make( 'separator', 'crb_separator_5', __( 'Update Email Notification' ) ),
		Field::make(
			'checkbox', 
			'___lift_remove_core_email',
			__('Disable Update Core email notification')
			)->set_option_value( 'yes' ),
		Field::make(
			'checkbox', 
			'___lift_remove_plugins_email',
			__('Disable Update Plugins email notification')
			)->set_option_value( 'yes' ),
		Field::make(
			'checkbox', 
			'___lift_remove_theme_email',
			__('Disable Update Themes email notification')
			)->set_option_value( 'yes' ),
	);
	return $data;
}

function Lift___men_c_o_p_y_r_i_g_h_t() {
	$data = array();
	$data = array(
		Field::make( 'separator', 'crb_separator_3', __( 'Copyright' ) ),

		Field::make( 'html', 'crb_html_4', __( 'Section Description' ) )
				->set_html('
				
				<p>Copyright by LIFT Creations</p>
				<p><strong>Author:</strong> <a href="https://baonguyenyam.github.io/cv/" target="_blank">Nguyen Pham</a></p>
				
				'),

	);
	return $data;
}
function Lift___menu_welcome() {
	$data = array();
	$data = array(
		// Field::make( 'separator', 'crb_separator_4', __( 'Welcome' ) ),

		Field::make( 'html', 'crb_html_5', __( 'Section Description' ) )
				->set_html('
				
				<p><img src="'.plugin_dir_url(__FILE__) .'admin/assets/img/logo.png"></p>
				<h1>Website Design and Web Development</h1>
				<h3 style="margin-top:0;">LIFT the Marketing Agency | Create Something Great.</h3>
				<p>Sharing your brand-vision through beautiful web page design and website development for higher rankings and conversions.</p>
				<p>The highest level of creative and professional engagement is what our crew brings to the brands we love. Branding, Website Design, Website Development, Social Media, Search Engine Optimization (SEO), Paid Search (PPC) and Video.
				</p>
				<p>LIFT Creations is a marketing agency that creates beautiful websites that are optimized for SEO and structured for higher conversions. Creative content and quality execution for digital design, web development, social media, search engine optimization, paid search, print, and video.</p>
				<hr>
				<p style="margin-top:0;margin-bottom:0"><strong>Email:</strong> <a href="mailto:hello@liftcreations.com" target="_blank">hello@liftcreations.com</a></p>
				<p style="margin-top:0;margin-bottom:0"><strong>Website:</strong> <a href="https://liftcreations.com/" target="_blank">liftcreations.com</a></p>
				<p style="margin-top:0;margin-bottom:0"><strong>Call Us:</strong> <a href="tel:866-244-1150" target="_blank">866-244-1150</a></p>
				
				'),

	);
	return $data;
}
function Lift___security() {
	$data = array();
	$data = array(
		Field::make( 'separator', 'crb_separator_7', __( 'Password' ) ),
		Field::make(
			'checkbox', 
			'___lift_disable_password_reset',
			__('Disable Password Reset')
			)->set_option_value( 'yes' )->set_help_text('Disable password reset functionality. Only users with administrator role will be able to change passwords from inside admin area.' ),
	);
	return $data;
}
function Lift___script() {
	$data = array();
	$data = array(
		Field::make( 'header_scripts', '__lift_header_scripts', __( 'Header Scripts' ) ),
		// Field::make( 'separator', 'crb_separator', __( 'Separator' ) ),,
		Field::make( 'footer_scripts', '__lift_footer_scripts', __( 'Footer Scripts' ) )
	);
	return $data;
}
function Lift___seometa() {
	$data = array();
	$data = array(
		// Field::make( 'file', 'crb_file', __( 'File' ) ),
		Field::make( 'header_scripts', '__lift_seo_meta', __( 'Header SEO Meta tags' ) )
		->set_rows(40)
		->set_hook_priority(-9999)
		->set_help_text( 'If you need to add HTML tags to your header, you should enter them here.' )
	);
	return $data;
}
function Lift___IMGError() {
	$result = $images_list = '';
	$query_images_args = array(
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'compare' => 'LIKE',
		's' => '_',
		'post_status'    => 'inherit',
		'posts_per_page' => -1,

	);
	$query_images = new WP_Query( $query_images_args );
	if($query_images->posts) {
		$images_list_num = 1;
		foreach ( $query_images->posts as $image ) {
			$url = pathinfo(wp_get_attachment_url( $image->ID ));
			$old_file = $url['filename'];
			$old_rename = substr(parse_url(wp_get_attachment_url( $image->ID ), PHP_URL_PATH),1);
			$images_list .= '<tr><td>'.$images_list_num.'</td><td>'.$old_file. '.'. $url['extension'].'</td></tr>';
			$images_list_num++;
		}
	} else {
		$images_list = '<tr><td colspan="2">Not found</td></tr>';
	}

	$result = '<table class="lift-table-admin">
		<tr>
			<th>File</th>
			<th>Name</th>
		</tr>
		'.$images_list.'
	</table>';
	if($query_images->posts) {
		$result .= '<form action="'.esc_attr('admin-post.php').'" method="post" style="padding-top:1rem">
			<input type="hidden" name="action" value="lift_img_error" />
			<input type="hidden" name="return" value="'.$_GET['page'].'">
			<input type="submit" value="Update" class="button button-primary button-large">
		</form>';
	}


	return $result;
}

add_action( 'carbon_fields_register_fields', 'lift_option_attach_theme_options' );
function lift_option_attach_theme_options() {
    Container::make( 'theme_options', __( 'LIFT Creations' ) )
		->set_page_menu_title( 'LIFT Settings' )
		->set_page_menu_position(2)
		->set_icon( 'dashicons-admin-generic' )
		->add_tab( __( 'Welcome' ), Lift___menu_welcome() )
		->add_tab( __( 'SEO Tags' ), Lift___seometa() )
        ->add_tab( __( 'Images' ), array(
			Field::make( 'html', 'crb_html_1', __( 'Section Description' ) )
				->set_html('With the LIFT plugin, you can quickly rename all your image URLs based on the post title.'),
			Field::make(
				'checkbox', 
				'___lift_auto_rename_img',
				__('Rename image file by post title')
				)->set_option_value( 'yes' )->set_help_text('you-img.jpg => post-title-you-img.jpg' ),
			Field::make( 'separator', 'crb_separator_6', __( 'Error images name' ) ),
			Field::make( 'html', 'crb_html_6', __( 'Section Description' ) )
				->set_html('
					'.Lift___IMGError().'
				'),
		) )
		->add_tab( __( 'Clean-Up' ), Lift_tabCleanUp() )
		->add_tab( __( 'Updates' ), Lift_tabUpdates() )
		->add_tab( __( 'Login' ), array(
			Field::make( 'image', '___lift_login_logo', __( 'Login Logo' ) )
			->set_value_type( 'url' )
            ->set_visible_in_rest_api( $visible = true )
			->set_width(40),
			Field::make( 'text', '___lift_login_logo_width', __( 'Width' ) )
			->set_default_value('300px')
			->set_classes( 'lift-cabon-width-class' )
			->set_width(20),
			Field::make( 'text', '___lift_login_logo_height', __( 'Height' ) )
			->set_default_value('80px')
			->set_classes( 'lift-cabon-width-class' )
			->set_width(20),
			Field::make( 'text', '___lift_login_logo_margin', __( 'Margin' ) )
			->set_default_value('30px')
			->set_classes( 'lift-cabon-width-class' )
			->set_width(20),
			Field::make( 'image', '___lift_login_bg', __( 'Login Background' ) )
			->set_value_type( 'url' )
            ->set_visible_in_rest_api( $visible = true )
			->set_width(40),
			Field::make( 'color', '___lift_login_bg_color', 'Login Background color' )
			->set_alpha_enabled( true )
			->set_width(30),
			Field::make(
				'select', 
				'___lift_login_style',
				__( 'Choose Style' )
			)->set_options( array(
				'default' => 'Default',
				'style-1' => 'Style 1',
				'style-2' => 'Style 2',
			) )
			->set_width(30),
		) )
		->add_tab( __( 'Security' ), Lift___security() )
		->add_tab( __( 'Scripts' ), Lift___script() )
		->add_tab( __( base64_decode('Q29weXJpZ2h0') ), Lift___men_c_o_p_y_r_i_g_h_t() )
		;
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'admin_post_lift_img_error', 'prefix_admin_lift_img_error' );

function prefix_admin_lift_img_error() {
	lift_admin_lift_img_error();
}
<?php 
// Admin MENU
function admin_lift_menu($meta = TRUE){
    global $wp_admin_bar;
        if ( !is_user_logged_in() ) { return; }
        if ( !is_admin_bar_showing() ) { return; }

    $wp_admin_bar->add_menu( array(
        'id' => 'lift_admin_bar_menu',
        'title' => __( '<span class="lifemx ab-icon ab-item"></span>LIFT Creations' ) ,
        'href'      => 'https://liftcreations.com/',
        'meta'   => array(
            'target'   => '_blank',
            'class'    => 'wpse--item',
            'tabindex' => PHP_INT_MAX,
        )
    ));

  $wp_admin_bar->add_menu( array(
    'parent'    => 'lift_admin_bar_menu',
    'title'     => '<span class="dashicons-before dashicons dashicons-groups"></span>About Us',
    'href'  => 'https://liftcreations.com/about/',
    'meta'  => array( 'target' => '_blank' )
   ));

    $wp_admin_bar->add_menu( array(
        'parent'    => 'lift_admin_bar_menu',
        'title'     => '<span class="dashicons-before dashicons dashicons-location"></span>Contact Us',
        'href'  => 'https://liftcreations.com/contact-us/',
        'meta'  => array( 'target' => '_blank' )
    ));
}
add_action( 'admin_bar_menu', 'admin_lift_menu' , 100);

// RENAME IMG 
add_action( 'carbon_fields_fields_registered', '___lift_auto_rename_img' );
function ___lift_auto_rename_img() {
    if(carbon_get_theme_option('___lift_auto_rename_img')) {
        add_filter( 'wp_handle_upload_prefilter', 'lift_custom_upload_filter' );
    }
}
function lift_custom_upload_filter( $file ) {
    if ( ! isset( $_REQUEST['post_id'] ) ) {
        return $file;
    }
    $id           = intval( $_REQUEST['post_id'] );
    $parent_post  = get_post( $id );
    $post_name    = sanitize_title( $parent_post->post_title );
    $file['name'] = $post_name . '-' . $file['name'];
    return $file;
}

// LOGIN LOGO 
add_action( 'login_enqueue_scripts', '___lift_login_logo' );
function ___lift_login_logo() {
    if(carbon_get_theme_option('___lift_login_logo')) {
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
            background-image: url(<?php echo carbon_get_theme_option('___lift_login_logo'); ?>);
            height:<?php echo carbon_get_theme_option('___lift_login_logo_height')?carbon_get_theme_option('___lift_login_logo_height'): 'initial'; ?>;
            width:<?php echo carbon_get_theme_option('___lift_login_logo_width')?carbon_get_theme_option('___lift_login_logo_width'): 'initial'; ?>;
            margin-bottom:<?php echo carbon_get_theme_option('___lift_login_logo_margin')?carbon_get_theme_option('___lift_login_logo_margin'): 'initial'; ?>;
            background-size: contain;
            background-position: center center;
            background-repeat: no-repeat;
            }
        </style>
        <?php
    }
    if(carbon_get_theme_option('___lift_login_style') && carbon_get_theme_option('___lift_login_style') ==='style-1') {
        ?>
        <style type="text/css">
            body.login,body.login #login>*{box-sizing:border-box}body.login #login>*{width:100%}body.login #login form{border-radius:5px}body.login #login #nav{text-align:center}@media only screen and (min-width:1000px){body.login #login{position:absolute;right:0;top:0;height:100vh;padding:0 2rem;display:flex;flex-direction:column;justify-content:flex-start;align-items:center;background:rgba(255,255,255,.8);box-shadow:0 0 8px 3px rgba(0,0,0,.15)}body.login #login h1{margin-top:100px}body.login #login form{background:0 0;border:0;padding:1rem 0;box-shadow:none}}
        </style>
        <?php
    }
    if(carbon_get_theme_option('___lift_login_style') && carbon_get_theme_option('___lift_login_style') ==='style-2') {
        ?>
        <style type="text/css">
            body.login,body.login #login>*{box-sizing:border-box}body.login #login>*{width:100%}body.login #login form{border-radius:5px}body.login #login #nav{text-align:center}@media only screen and (min-width:1000px){body.login #login{position:absolute;left:0;top:0;height:100vh;padding:0 2rem;display:flex;flex-direction:column;justify-content:flex-start;align-items:center;background:rgba(255,255,255,.8);box-shadow:0 0 8px 3px rgba(0,0,0,.15)}body.login #login h1{margin-top:100px}body.login #login form{background:0 0;border:0;padding:1rem 0;box-shadow:none}}
        </style>
        <?php
    }
    if(carbon_get_theme_option('___lift_login_bg_color') || carbon_get_theme_option('___lift_login_bg')) {
        ?>
        <style type="text/css">
            body.login {
            <?php if(carbon_get_theme_option('___lift_login_bg')) { ?>
            background-image: url(<?php echo carbon_get_theme_option('___lift_login_bg'); ?>);
            <?php } ?>
            <?php if(carbon_get_theme_option('___lift_login_bg_color')) { ?>
            background-color: <?php echo carbon_get_theme_option('___lift_login_bg_color'); ?>;
            <?php } ?>
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            }
        </style>
        <?php
    }
}

// UPDATE 

add_action( 'carbon_fields_fields_registered', '___lift_remove_core_email' );
function ___lift_remove_core_email() {
    if(carbon_get_theme_option('___lift_remove_core_email')) {
        add_filter('auto_core_update_send_email', '__return_false' );
    }
}
add_action( 'carbon_fields_fields_registered', '___lift_remove_plugins_email' );
function ___lift_remove_plugins_email() {
    if(carbon_get_theme_option('___lift_remove_plugins_email')) {
        add_filter('auto_plugin_update_send_email', '__return_false');
    }
}
add_action( 'carbon_fields_fields_registered', '___lift_remove_theme_email' );
function ___lift_remove_theme_email() {
    if(carbon_get_theme_option('___lift_remove_theme_email')) {
        add_filter('auto_theme_update_send_email', '__return_false');
    }
}
add_action( 'carbon_fields_fields_registered', '___lift_remove_core_update' );
function ___lift_remove_core_update() {
    if(carbon_get_theme_option('___lift_remove_core_update')) {
        add_filter('pre_option_update_core', '__return_null');
        add_filter('pre_site_transient_update_core','lift_remove_wp_core_updates');
    }
}
add_action( 'carbon_fields_fields_registered', '___lift_remove_plugins_update' );
function ___lift_remove_plugins_update() {
    if(carbon_get_theme_option('___lift_remove_plugins_update')) {
        add_filter('auto_update_plugin', '__return_false' );
        add_filter('plugins_auto_update_enabled', '__return_false' );
        add_filter('site_transient_update_plugins', '__return_null' );
        remove_action('load-update-core.php', 'wp_update_plugins');
        add_filter('pre_site_transient_update_plugins','lift_remove_wp_core_updates');
    }
}
add_action( 'carbon_fields_fields_registered', '___lift_remove_theme_update' );
function ___lift_remove_theme_update() {
    if(carbon_get_theme_option('___lift_remove_theme_update')) {
        add_filter('auto_update_theme', '__return_false' );
        add_filter('themes_auto_update_enabled', '__return_false' );
        add_filter('site_transient_update_themes', '__return_null' );
        remove_action('load-update-core.php', 'wp_update_themes');
        add_filter('pre_site_transient_update_themes','lift_remove_wp_core_updates');
    }
}
function lift_remove_wp_core_updates(){
    global $wp_version;
    return(object) array('last_checked' => time(),'version_checked' => $wp_version);
}


// COMMENT 
add_action( 'carbon_fields_fields_registered', '___lift_disable_comments' );
function ___lift_disable_comments() {
    if(carbon_get_theme_option('___lift_disable_comments')) {
        add_action('admin_init', function () {
            global $pagenow;
            if ($pagenow === 'edit-comments.php') {
                wp_redirect(admin_url());
                exit;
            }
            remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
            foreach (get_post_types() as $post_type) {
                if (post_type_supports($post_type, 'comments')) {
                    remove_post_type_support($post_type, 'comments');
                    remove_post_type_support($post_type, 'trackbacks');
                }
            }
        });
        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);
        add_filter('comments_array', '__return_empty_array', 10, 2);
        add_action('admin_menu', function () {
            remove_menu_page('edit-comments.php');
        });
        add_action('init', function () {
            if (is_admin_bar_showing()) {
                remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
            }
        });
        add_action('wp_before_admin_bar_render', function() {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('comments');
        });
    }
}

// DISABLE PASSWORD RESET 
add_action( 'carbon_fields_fields_registered', '___lift_disable_password_reset' );
function ___lift_disable_password_reset() {
    if(carbon_get_theme_option('___lift_disable_password_reset')) {
        new LIFT_Password_Reset_Removed();
    }
}


// add_filter( 'wp_nav_menu_items', 'lift_add_shortcode_to_menu_items', 10, 2 );
// function lift_add_shortcode_to_menu_items ( $items, $args ) {
//     var_dump($items);
//     // $string = preg_replace("/<a\s(.+?)>(.+?)<\/a>/is", "$2", $items);
//     // var_dump($string);
//     // if ( preg_match( '/\[(.+?)]/', $string ) ) {
//     //   echo(1);
//         // $newstring = do_shortcode( $string );
//     // } else {
//         // $newstring = $items;
//     // }
//     return $items;
// }
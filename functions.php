<?php
/**
Divi Child Theme
 * Functions.php
 *
 * ===== NOTES ==================================================================
 * 
 * Unlike style.css, the functions.php of a child theme does not override its 
 * counterpart from the parent. Instead, it is loaded in addition to the parent's 
 * functions.php. (Specifically, it is loaded right before the parent's file.)
 * 
 * In that way, the functions.php of a child theme provides a smart, trouble-free 
 * method of modifying the functionality of a parent theme. 
 * 
 * =============================================================================== */

// Fix for Cookies Blocked Error starts


setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN);
if ( SITECOOKIEPATH != COOKIEPATH ) setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN);

// Fix for Cookies Blocked Error Ends
 
//  function auto_featured_image() {
//     global $post;
 
//     if (!has_post_thumbnail($post->ID)) {
//         $attached_image = get_children( "post_parent=$post->ID&amp;post_type=attachment&amp;post_mime_type=image&amp;numberposts=1" );
         
//       if ($attached_image) {
//               foreach ($attached_image as $attachment_id => $attachment) {
//                    set_post_thumbnail($post->ID, $attachment_id);
//               }
//          }
//     }
// }
// // Use it temporary to generate all featured images
// add_action('the_post', 'auto_featured_image');
// // Used for new posts
// add_action('save_post', 'auto_featured_image');
// add_action('draft_to_publish', 'auto_featured_image');
// add_action('new_to_publish', 'auto_featured_image');
// add_action('pending_to_publish', 'auto_featured_image');
// add_action('future_to_publish', 'auto_featured_image');

// add editor the privilege to edit theme
// get the the role object
$role_object = get_role( 'editor' );
// add $cap capability to this role object
$role_object->add_cap( 'edit_theme_options' );



// https://wordpress.stackexchange.com/questions/117344/failed-to-import-media
add_filter( 'http_request_host_is_external', '__return_true' );

// Remove query strings from static resources
function _remove_script_version( $src ){
    $parts = explode( '?ver', $src );
        return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
//  Remove query strings from static resources

function divichild_enqueue_scripts() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
//     wp_enqueue_style( 'fontawsome-style', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css' );
}
add_action( 'wp_enqueue_scripts', 'divichild_enqueue_scripts' );

function js_script_enqueue() {
    wp_enqueue_script( 'custom-scripts', get_stylesheet_directory_uri() . '/script.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'js_script_enqueue' );

function bccms_custom_wp_admin_style(){
    wp_register_style( 'custom_wp_admin_css', get_bloginfo('stylesheet_directory') . '/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action('admin_enqueue_scripts', 'bccms_custom_wp_admin_style');

function bccms_custom_wp_admin_script(){
    wp_register_script( 'custom_wp_admin_css', get_bloginfo('stylesheet_directory') . '/admin-script.js', false, '1.0.0' );
    wp_enqueue_script( 'custom_wp_admin_css' );
}
add_action('admin_enqueue_scripts', 'bccms_custom_wp_admin_script');

/***  Add Links to the WordPress Admin Bar ***/

 if( current_user_can('edit_others_pages') ) {  

add_action('admin_bar_menu', 'add_toolbar_items', 100);
function add_toolbar_items($admin_bar){
  
  // 	Edit Theme Library Items
    $admin_bar->add_menu( array(
        'id'    => 'awp-tools',
        'title' => 'AaryaWP Tools',
        'href'  => '',
        'meta'  => array(
            'title' => __('AaryaWP Tools'),  
            'class' => 'awp-tools'
        ),
    ));
 		$admin_bar->add_menu( array(
        'id'    => 'edit-my-theme',
        'parent' => 'awp-tools',
        'title' => 'Edit My Theme',
        'href'  => '#',
        'meta'  => array(
            'title' => __('Edit My Theme'),
            'target' => '_blank',
            'class' => 'my_menu_item_class'
        	),
    	));
        $admin_bar->add_menu( array(
        'id'    => 'edit-my-header',
        'parent' => 'edit-my-theme',
        'title' => 'Edit My Header',
        'href'  => '/et_pb_layout/header/?et_fb=1',
        'meta'  => array(
            'title' => __('Edit Header'),
            'target' => '_blank',
            'class' => 'my_menu_item_class'
            ),
        ));
        $admin_bar->add_menu( array(
        'id'    => 'edit-my-footer',
        'parent' => 'edit-my-theme',
        'title' => 'Edit My Footer',
        'href'  => '/et_pb_layout/footer/?et_fb=1',
        'meta'  => array(
            'title' => __('Edit Footer'),
            'target' => '_blank',
            'class' => 'my_menu_item_class'
            ),
         ));
// 	clear cache pages by Refreshing
	  $admin_bar->add_menu( array(
        'id'    => 'refresh-cachepages',
        'parent' => 'awp-tools',
        'title' => 'Refresh Caches',
        'href'  => '',
        'meta'  => array(
            'title' => __('Refresh Caches'),
            'target' => '',
            'class' => 'my_menu_item_class'
        ),
    ));
				$admin_bar->add_menu( array(
        		'id'    => 'refresh-style-css',
        		'parent' => 'refresh-cachepages',
        		'title' => 'Refresh style.css',
        		'href'  => '/wp-content/themes/divi-child/style.css',
        		'meta'  => array(
           	 	'title' => __('Refresh style.css'),
            	'target' => '_blank',
            	'class' => 'my_menu_item_class'
        		),
    			));
				$admin_bar->add_menu( array(
        		'id'    => 'refresh-script-js',
        		'parent' => 'refresh-cachepages',
        		'title' => 'Refresh script.js',
        		'href'  => '/wp-content/themes/divi-child/script.js',
        		'meta'  => array(
           	 	'title' => __('Refresh script.js'),
            	'target' => '_blank',
            	'class' => 'my_menu_item_class'
        		),
    			));
  // 	theme settings - CSS
	  $admin_bar->add_menu( array(
        'id'    => 'theme-css',
        'parent' => 'awp-tools',
        'title' => 'Theme Settings CSS',
        'href'  => '/wp-admin/admin.php?page=et_divi_options',
        'meta'  => array(
           'title' => __('Theme Settings CSS'),
           'target' => '_blank',
           'class' => 'my_menu_item_class'
        ),
    ));
  // 	Cloudflare Purge Cache
	  $admin_bar->add_menu( array(
        'id'    => 'cloudflare-purge-cahce',
        'parent' => 'awp-tools',
        'title' => 'Cloudflare Purge Cache',
        'href'  => '/wp-admin/options-general.php?page=cloudflare#/home',
        'meta'  => array(
           'title' => __('Cloudflare Purge Cache'),
           'target' => '_blank',
           'class' => 'my_menu_item_class'
        ),
    ));	
	
  //end 
	}
} 
// /** starts add_shortcode []  as a shortcode Use [year] in your posts. */
function et_get_footer_credits() {
  $site_title = get_bloginfo( 'name' );
  $developed_by = ' | Powered by <a href="https://digitalindiya.com" target="_blank">DigitalIndiya.com</a>'; // Developer info
  $terms = '<br><a href="/privacy-policy">Privacy Policy</a> | <a href="/terms">Terms and Conditions</a>'; // Privacy and Terms of Condition links (comment to remove)
  $beg_year = 2017;
  $cur_year = intval(date('Y'));
  if($cur_year > $beg_year) {
    $display_year = $beg_year . ' - ' . $cur_year;
  } else {
    $display_year = $cur_year;
  }
  $footer_credits = '&copy; ' . $cur_year . '. ' . $site_title .' .' . $developed_by . $terms;
  $credits_format = '<%2$s id="footer-info">%1$s</%2$s>';
  return et_get_safe_localization( sprintf( $credits_format, $footer_credits, 'div' ) );
}

// function site_logo_wpccms( ){
// return et_get_option( 'divi_logo' );
// }
// add_shortcode( 'site_logo', 'site_logo_wpccms' );

// /** End add_shortcode []  as a shortcode */

// // Adding divi builder to custom post tyes starts
// function my_et_builder_post_types( $post_types ) {
//     $post_types[] = 'theme-layout';
//     $post_types[] = 'knowledgebase';
//     // $post_types[] = 'ANOTHER_CPT_HERE';
     
//     return $post_types;
// }
// add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );
// // Adding divi builder to custom post tyes ends


// https://wordpress.stackexchange.com/questions/111183/post-featured-image-column-on-admin-post-list-page

add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
    $columns['img'] = 'Featured Image';
    return $columns;
}

function manage_img_column($column_name, $post_id) {
    if( $column_name == 'img' ) {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }
    return $column_name;
}

// show post ID in an admin column

add_filter( 'manage_posts_columns', 'revealid_add_id_column', 5 );
add_action( 'manage_posts_custom_column', 'revealid_id_column_content', 5, 2 );

function revealid_add_id_column( $columns ) {
   $columns['revealid_id'] = 'ID';
   return $columns;
}
 
function revealid_id_column_content( $column, $id ) {
  if( 'revealid_id' == $column ) {
    echo $id;
  }
}


// Add Custom Widgets Header Footer and in Backend
function dividose_widgets_init() {
   register_sidebar( array(
  'name'          => __( 'Header', 'dividose' ),
	'id'            => 'header',
	'description'   => '',
        'class'         => 'dividose-header',
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget'  => '</section',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
    ) );
  register_sidebar( array(
  'name'          => __( 'Footer', 'dividose' ),
	'id'            => 'footer',
	'description'   => '',
        'class'         => 'dividose-footer',
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget'  => '</section',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>'
    ) );
 
}
  add_action( 'widgets_init', 'dividose_widgets_init' );

//Shortcode to show the library [library id="786"]
function library_shortcode($moduleid) {
extract(shortcode_atts(array('id' =>'*'),$moduleid)); 
return do_shortcode('[et_pb_section global_module="'.$id.'"][/et_pb_section]');
}
add_shortcode('library', 'library_shortcode');


// Add Custom Widgets Header Footer and in Frontend
function show_dividose_widgets() { ?>
    <div id="dividose-header">
        <?php dynamic_sidebar('header'); ?>
	 </div>
</div>
    <div id="dividose-footer">
        <?php dynamic_sidebar('footer'); ?>
	 </div>
</div>
<div id="logo-site-title"><h1><a href="/"><?php echo get_bloginfo('name');?></a></h1></div>
<?php 
} 
add_action('wp_footer', 'show_dividose_widgets');


//Remove unwanted widgets from Dashboard
// function remove_dashboard_widgets() {
// 	global$wp_meta_boxes; 
// 	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
// 	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
// }
// add_action('wp_dashboard_setup', 'remove_dashboard_widgets');



// “Last Updated” Date to Divi’s Blog Post Meta Data
// https://www.elegantthemes.com/blog/divi-resources/how-to-add-the-last-updated-date-to-divis-blog-post-meta-data
// function et_last_modified_date_blog( $the_date ) {
//     if ( 'post' === get_post_type() ) {
//         $the_time = get_post_time( 'His' );
//         $the_modified = get_post_modified_time( 'His' );
 
//       $last_modified =  sprintf( __( 'Last updated %s' , 'Divi' ), esc_html( get_post_modified_time( 'M j, Y \a\t g:iA' ) ) );
//         $published =  sprintf( __( 'Published on %s', 'Divi' ), esc_html( get_post_time( 'M j, Y' ) ) );
 
//        $date = $the_modified !== $the_time ? $last_modified . ' | ' .  $published : $published;
 
//         return $date;
//     }
// }
// add_action( 'get_the_date', 'et_last_modified_date_blog' );
// add_action( 'get_the_time', 'et_last_modified_date_blog' );

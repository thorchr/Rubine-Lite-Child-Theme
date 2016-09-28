<?php
/* Lag en funksjon for å legge stilarkene i innlastingskø */
function derrick_style_queue() {

	/* Gjør klar en variabel for å sette foreldretemaets stilark i køen */
    $parent_style = 'parent-style';

	/* Legg foreldrestilarket i innlastingskøen */
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    /* Legg child themets stilark i innlastingskøen */
	wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css', array( $parent_style ));
}
/* Knytt stilarkkøen til WordPress' scriptinnlastingskø */
add_action( 'wp_enqueue_scripts', 'derrick_style_queue' );



$page_id = "";
$product_pages_args = array(
'meta_key' => '_wp_page_template',
'meta_value' => 'login.php'
);

$product_pages = get_pages( $product_pages_args );
foreach ( $product_pages as $product_page ) {
$page_id.= $product_page->ID;
}

function goto_login_page() {
global $page_id;
$login_page = home_url( '/?page_id='. $page_id. '/' );
$page = basename($_SERVER['REQUEST_URI']);

if( $page == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
wp_redirect($login_page);
exit;
}
}
add_action('init','goto_login_page');

function login_failed() {
global $page_id;
$login_page = home_url( '/?page_id='. $page_id. '/' );
wp_redirect( $login_page . '&login=failed' );
exit;
}
add_action( 'wp_login_failed', 'login_failed' );

function blank_username_password( $user, $username, $password ) {
global $page_id;
$login_page = home_url( '/?page_id='. $page_id. '/' );
if( $username == "" || $password == "" ) {
wp_redirect( $login_page . "&login=blank" );
exit;
}
}
add_filter( 'authenticate', 'blank_username_password', 1, 3);

//echo $login_page = $page_path ;

function logout_page() {
global $page_id;
$login_page = home_url( '/?page_id='. $page_id. '/' );
wp_redirect( $login_page . "&login=false" );
exit;
}
add_action('wp_logout', 'logout_page');

$page_showing = basename($_SERVER['REQUEST_URI']);

if (strpos($page_showing, 'failed') !== false) {
echo '<p class="error-msg"><strong>ERROR:</strong> Invalid username and/or password.</p>';
}
elseif (strpos($page_showing, 'blank') !== false ) {
echo '<p class="error-msg"><strong>ERROR:</strong> Username and/or Password is empty.</p>';
}

add_action( 'wp_ajax_nopriv_submit_content', 'my_submission_processor' );
add_action( 'wp_ajax_submit_content', 'my_submission_processor' );


function my_submission_processor() {
	$post_data = array(
		'post_title' => $_POST['post_title'],
		'post_content' => $_POST['post_content'],
		'post_status' => 'draft'
	);

	$post_id = wp_insert_post( $post_data );

	wp_redirect( site_url() . '/thank-you/' );

	die();
}

add_theme_support( 'post-thumbnails' );




add_theme_support( 'get_post_format','has_post_format', 'post-formats', array( 'aside', 'gallery' ) );

function wpb_postsbycategory() {
// the query
$the_query = new WP_Query( array( 'category_name' => 'referanser', 'posts_per_page' => 21) ); 

// The Loop
if ( $the_query->have_posts() ) {
	$string .= '<ul class="postsbycategory widget_recent_entries">';
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
			if ( has_post_thumbnail() ) {
			$string .= '<li>';
			$string .= '<a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_post_thumbnail($post_id, array( 50, 50) ) . get_the_title() .'</a></li>';
			} else { 
			// if no featured image is found
			$string .= '<li><a href="' . get_the_permalink() .'" rel="bookmark">' . get_the_title() .'</a></li>';
			}
			}
	} else {
	// no posts found
}
$string .= '</ul>';

return $string;

/* Restore original Post Data */
wp_reset_postdata();
}


// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');



function my_login_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'administrator' ) ) {
            $url = admin_url();
        } else {
            $url = home_url('/filopplasting/');
        }
    }
    return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );



function files($file_handler,$post_id,$set_thu=false) {
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );

         // If you want to set a featured image frmo your uploads. 
	if ($set_thu) set_post_thumbnail($post_id, $attach_id);
	return $attach_id;
}

function upload_user_file( $file = array(),$path ) {
    if(!empty($file)) 
    {


        $upload_dir=$path;
        $uploaded=move_uploaded_file($file['tmp_name'], $upload_dir.$file['name']);
        if($uploaded) 
        {
            echo "uploaded successfully ";

        }else
        {
            echo "some error in upload " ;print_r($file['error']);  
        }
    }

}

/**
 * Provides a standard format for the page title depending on the view. This is
 * filtered so that plugins can provide alternative title formats.
 *
 * @param       string    $title    Default title text for current view.
 * @param       string    $sep      Optional separator.
 * @return      string              The filtered title.
 * @package     mayer
 * @subpackage  includes
 * @version     1.0.0
 * @since       1.0.0
 */
function mayer_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	} // end if

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	} // end if

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = sprintf( __( 'Page %s', 'mayer' ), max( $paged, $page ) ) . " $sep $title";
	} // end if

	return $title;

} 

// end mayer_wp_title
add_filter( 'wp_title', 'mayer_wp_title', 10, 2 );


?>
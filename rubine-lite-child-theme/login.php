<?php
/*
* Template Name: Login Page
*/
?>

<?php get_header(); ?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">
		
		<?php if ( function_exists( 'themezee_breadcrumbs' ) ) themezee_breadcrumbs(); ?>
			
		<?php if (have_posts()) : while (have_posts()) : the_post();

			get_template_part( 'content', 'page' );

			endwhile;

		endif; ?>
				
		</section>
		
		
		
	</div>
	


<div class="wp_login_form">
<div class="form_heading"> INNLOGGING FOR FILOPPLASTING</div>

<?php
$args = array(
'redirect' => home_url(),
'id_username' => 'user',
'id_password' => 'pass',
)
;?>

<?php wp_login_form( $args ); ?>
<div class="register_link"><a href="http://wp.me/P7nwoI-9n">Registrer deg som kunde</a></div>

</div>

<?php get_footer(); ?>
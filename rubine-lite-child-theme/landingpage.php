<?php 
/*
Template Name: Forside
*/

get_header(); ?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">
		
		<?php query_posts('category_name=Kundecase&showposts=4'); ?>
			
		<?php if (have_posts()) : while (have_posts()) : the_post();

			get_template_part( 'content', 'landingpage' );

			endwhile;

		endif; ?>
		
		
		
		</section>
			<?php get_sidebar() ?>
	</div>
	
<?php get_footer(); ?>
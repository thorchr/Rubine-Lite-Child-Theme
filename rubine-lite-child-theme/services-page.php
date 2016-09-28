<?php
/*
Template Name: Tjenester
*/

 get_header(); ?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">
		
		<?php query_posts('category_name=Tjenester&showposts=3'); ?>
			
		<?php if (have_posts()) : while (have_posts()) : the_post();

			get_template_part( 'content', 'page' );

			endwhile;

		endif; ?>
		
	
		
		</section>
		
	
		
	</div>
	
<?php get_footer(); ?>
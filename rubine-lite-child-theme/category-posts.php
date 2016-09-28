<?php
/* template name: Posts by Category! */
get_header(); ?>
		<div id="wrap" class="container clearfix">
		
		<?php wdp_slider(2); ?>
		<section id="content-full" class="clearfix" role="main">
	    
		<?php
 				$lastposts = get_posts('category_name=Referanser&numberposts=1');
 				foreach($lastposts as $post) :
    			setup_postdata($post);
 		?>
		<?php the_post_thumbnail('small'); ?>
 		<?php the_excerpt(); ?>
 		<a href="<?php esc_url(the_permalink()) ?>" class="more-link"><?php esc_html_e( 'Les mer', 'rubine-lite' ); ?></a>
 		<?php endforeach; ?>
		

		<?php query_posts('category_name=Referanser&showposts=20'); ?>
<ul>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>
<?php endif; ?>



					
			
		
		
		
		</section>


	</div>
	
	

<?php get_footer(); ?>
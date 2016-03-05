<?php
/*
Template Name: Archivio_3.0
*/
get_header(); ?>

<!--BEGIN #content -->
<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<!-- #hentry-wrap -->
		<div id="hentry-wrap">
			
			<!--BEGIN .hentry -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				
				<!--BEGIN .post-meta .post-header-->
				<div class="post-meta post-header">

					<h1 class="page-title"><?php the_title(); ?></h1>

					<!--END .post-meta post-header -->
				</div>
				
				<!--BEGIN .post-content -->
				<div class="post-content">
					<?php the_content(); ?>
					<div class="container">
					<ul class="row">
							<?php 
							$next_cat = get_category_by_slug('next');
							if (function_exists('put_cat_icons')) 
								put_cat_icons(wp_list_categories('exclude=1,22,30,31,32,33,34,35,36,37,9&title_li=&echo=0'),'icons_only=true'); 
							else wp_list_categories('title_li');
							?>
						</ul>
					</div>
					<!--END .post-content -->
				</div>

				<!--END .hentry-->  
			</div>
			
		<?php endwhile; else : ?> 

		<p><?php _e('No posts found', 'engine'); ?></p> 

	<?php endif; ?>

</div>
<!-- /#hentry-wrap -->

</div><!-- #content -->

<?php get_footer(); ?>
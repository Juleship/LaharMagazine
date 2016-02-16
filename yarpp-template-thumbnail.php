<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>

<hr>

<?php if (have_posts()):?>
<h3 class="text-center">CONTINUA A LEGGERE</h3>


		<?php while (have_posts()) : the_post(); ?>
			<a href="<?php the_permalink() ?>" class="not-tag" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<h4><? the_title() ?></h4>
				<span>di <? the_tags('') ?></span>

			<a href="<?php the_permalink() ?>" class="not-tag" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<p>
					<? the_excerpt() ?>
				</p>
			</a>
			<br>
		<?php endwhile; ?>
	

<?php else: ?>
<?php endif; ?>

<?php get_header()?>
<div id="homecol">



<?php if (have_posts()) : ?><?php while (have_posts()) : the_post(); ?>


<div class="polaroid">
<div class="polaroidimage"><a href="<?php the_permalink()?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
echo get_the_post_thumbnail($post->ID);
} else {
echo main_image();
} ?>
</a></div>
<div class="polaroidtitle"><a href="<?php the_permalink()?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title()?></a></div>
<div class="polaroiddate"><?php the_date()?></div>
</div>




<?php endwhile; ?>

<div class="navigation">
<span class="prevlink"><?php next_posts_link('Previous entries') ?></span>
<span class="nextlink"><?php previous_posts_link('Next entries') ?></span>
</div>
		
<?php else : ?>
<h1><?php _e('No posts found','polaroids')?></h1>
<p><?php _e('There are no posts to display here.','polaroids')?></p>
<?php endif; ?>


		
		
		
</div>
<?php get_footer()?>
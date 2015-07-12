<?php get_header()?>
	<div id="maincontent">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); //The Loop?>
		<div <?php post_class()?>>
			<h1><?php the_title()?></h1>
			<div class="date"><?php the_date()?></div>
			
			<div class="post-content"><?php the_content()?></div>
			
			<div class="postfooter">
			<?php wp_link_pages('before=Pages&after='); ?><br/>
			<?php if(has_tag()){the_tags( _e('Keywords','polaroids') . ': ', ', ');}?><br/>
			Categories: <?php the_category(', '); ?>
			
			</div>
		</div>
		
		
<?php comments_template( '', true ); ?>
		<?php endwhile;endif;?>
	</div>
	
<?php get_footer()?>
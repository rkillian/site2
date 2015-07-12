<?php get_header(); ?>
<div id="maincontent">

<?php if (have_posts()) : ?>



<?php
							if ( is_category() ) {
								printf( __( 'Category Archives: %s', 'polaroids' ), '<span>' . single_cat_title( '', false ) . '</span>' );

							} elseif ( is_tag() ) {
								printf( __( 'Tag Archives: %s', 'polaroids' ), '<span>' . single_tag_title( '', false ) . '</span>' );

							} elseif ( is_author() ) {
								printf( __( 'Author News Archive %s', 'polaroids' ), '<span>' . single_tag_title( '', false ) . '</span>' );

							} elseif ( is_day() ) {
								printf( __( 'Daily Archives: %s', 'polaroids' ), '<span>' . get_the_date() . '</span>' );

							} elseif ( is_month() ) {
								printf( __( 'Monthly Archives: %s', 'polaroids' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

							} elseif ( is_year() ) {
								printf( __( 'Yearly Archives: %s', 'polaroids' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

							} else {
								_e( 'Archives', 'polaroids' );

							}
						?>
 	  <?php } ?>

<div class="post">
<?php while (have_posts()) : the_post(); ?>
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

<?php the_content() ?>
<div class="postfooter">
Posted: <?php the_date('jS-M-Y', '', ''); ?><br/>
Categories: <?php the_category(', ') ?><br/>
Tags: <?php the_tags(''); ?><br/>
Comments: <a href="<?php comments_link(); ?>"><?php comments_number('No Comments','1 Comment','% Comments'); ?></a>.
</div>


</div>
<?php endwhile; ?>


<?php else : ?>
<?php endif; ?>

</div>
<?php get_footer(); ?>
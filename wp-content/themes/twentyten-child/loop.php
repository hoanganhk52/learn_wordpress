<?php
/* echo '<pre>';
print_r($wp_query);
echo '</pre>'; */
?>
<style>
	.zendvn-loop {
		list-style-type: none;
	}

	.zendvn-loop li {
		border: 1px solid #ccc;
		padding: 8px;
		margin-bottom: 10px;
	}

	.zendvn-loop .blue {
		background: #41b7d8;
	}
</style>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
		<div
			class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
		<div
			class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
	</div><!-- #nav-below -->
<?php endif; ?>
<?php
$paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$arrQuery = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1,
	'post_status'         => 'publish',
	'posts_per_page'      => 3,
	'paged'               => $paged
);
$wp_query = new WP_Query( $arrQuery );
?>
<?php
if ( have_posts() ) {
	echo '<ul class="zendvn-loop">';
	while ( have_posts() ) {
		the_post();
		$css = '';
		if ( in_category( 3 ) ) {
			$css = ' class="blue" ';
		}
		?>
		<li <?php echo $css; ?>>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div>id: <?php the_ID(); ?> - time: <?php the_time(); ?></div>
			<div>Author: <?php the_author(); ?></div>
			<div><?php the_tags(); ?></div>
			<div>Category: <?php the_category( ' ' ); ?></div>
			<div>Excerpt: <?php the_excerpt(); ?></div>
		</li>
		<?php
	}
	//wp_reset_query();
	wp_reset_postdata();
	echo '</ul>';
} else {

}
?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-below" class="navigation">
		<div
			class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyten' ) ); ?></div>
		<div
			class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
	</div><!-- #nav-below -->
<?php endif; ?>
<?php

$paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$myOffset = 3 * $paged;
$arrQuery = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1,
	'post_status'         => 'publish',
	'posts_per_page'      => 5,
	'paged'               => $paged,
	'offset'              => $myOffset
);

$wp_query = new WP_Query( $arrQuery );
?>
<div>
	<div>Cac bai viet khac</div>
	<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br/>
	<?php endwhile;
		wp_reset_postdata(); endif; ?>
</div>









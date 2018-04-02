<?php
/**
 * The loop that displays a single post
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-single.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
?>
<?php 
	/* echo '<pre>';
	print_r($wp_query);
	echo '</pre>'; */
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="nav-above" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-above -->

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"><?php the_title(); ?></h1>

					<div class="entry-meta">
						<?php twentyten_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php 
					/* _zend_mp_mb_data2_profile
					_zend_mp_mb_data2_level
					_zend_mp_mb_data2_author
					_zend_mp_mb_data2_price */
					
					$zendvn_price = get_post_meta(get_the_ID(),'_zend_mp_mb_data2_price',true);
					if(!empty($zendvn_price)) $zendvn_price = '<li>Price: ' . $zendvn_price . '</li>';
					
					$zendvn_author = get_post_meta(get_the_ID(),'_zend_mp_mb_data2_author',true);
					if(!empty($zendvn_author)) $zendvn_author = '<li>Author: ' . $zendvn_author . '</li>';
					
					$zendvn_level = get_post_meta(get_the_ID(),'_zend_mp_mb_data2_level',true);
					if(!empty($zendvn_level)) $zendvn_level = '<li>Level: ' . $zendvn_level . '</li>';
					
					$zendvn_profile = get_post_meta(get_the_ID(),'_zend_mp_mb_data2_profile',true);
					if(!empty($zendvn_profile)) $zendvn_profile = '<li>Author profile: ' . $zendvn_profile . '</li>';
					?>
					
					

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					<?php 
					if(!empty($zendvn_price) || !empty($zendvn_author) || !empty($zendvn_level) || !empty($zendvn_profile)):
					$metacssUrl = dirname(get_bloginfo('stylesheet_url')) . '/css/metabox.css';
					?>
					<link rel="stylesheet" type="text/css" media="all" href="<?php echo $metacssUrl;?>">
					<div class="zendvn-meta-box">
						<ul>
							<?php echo $zendvn_price . ' ' . $zendvn_author . $zendvn_level . $zendvn_profile;?>
						</ul>
					</div>
					<?php endif;?>

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php
							/** This filter is documented in author.php */
							echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) );
							?>
						</div><!-- #author-avatar -->
						<div id="author-description">
							<h2><?php printf( __( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyten' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	-->
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>

					<div class="entry-utility">
						<?php twentyten_posted_in(); ?>
						<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- #post-## -->

				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentyten' ) . '</span> %title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '</span>' ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

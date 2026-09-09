<?php
/**
 * Template for standard WordPress pages.
 *
 * @package marcosdicapriodev
 */

get_header();
?>

<main class="site-main single-post single-page">
	<?php while (have_posts()): ?>
		<?php the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="post-header">
				<h1 class="post-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(array(
					'before' => '<div class="page-links">' . esc_html__('Páginas:', 'marcosdicapriodev'),
					'after'  => '</div>',
				));
				?>
			</div>
		</article>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>

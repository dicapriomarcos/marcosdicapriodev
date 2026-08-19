<?php
/**
 * Static front page.
 *
 * Keeps the editorial home layout when WordPress is configured to use a page
 * as the site front page.
 */

get_header();

$paged = max(1, get_query_var('paged'), get_query_var('page'));
$latest_posts = new WP_Query(array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'paged' => $paged,
));
?>

<main class="site-main site-main--archive">
	<section class="home-hero" aria-labelledby="home-hero-title">
		<h1 id="home-hero-title" class="hero-title">
			<span><?php esc_html_e('Código y producto', 'marcosdicapriodev'); ?></span>
			<span><em><?php esc_html_e('digital', 'marcosdicapriodev'); ?></em> <strong class="hero-title__marker"><?php esc_html_e('bien hecho', 'marcosdicapriodev'); ?></strong><span class="hero-title__dot">.</span></span>
		</h1>
		<p class="hero-copy">
			<?php esc_html_e('Desarrollo web profesional a medida para WordPress', 'marcosdicapriodev'); ?>
		</p>
		<a class="hero-scroll" href="#latest-posts">
			<span><?php esc_html_e('Ver artículos', 'marcosdicapriodev'); ?></span>
			<span class="hero-scroll__arrow" aria-hidden="true">↓</span>
		</a>
	</section>

	<section class="archive-section" id="latest-posts" aria-labelledby="archive-title">
		<header class="section-heading">
			<p class="section-kicker"><?php esc_html_e('Cuaderno digital', 'marcosdicapriodev'); ?></p>
			<h2 id="archive-title"><?php esc_html_e('Últimos artículos', 'marcosdicapriodev'); ?></h2>
		</header>

		<div class="post-list">
		<?php if ($latest_posts->have_posts()): ?>
			<?php while ($latest_posts->have_posts()):
				$latest_posts->the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
					<span class="post-index" aria-hidden="true"><?php echo esc_html(sprintf('%02d', $latest_posts->current_post + 1)); ?></span>
					<div class="post-item__content">
						<div class="post-meta">
							<time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
							<span class="sep"> | </span>
							<span class="reading-time"><?php echo esc_html(mdw_reading_time()); ?></span>
							<?php $categories = get_the_category(); ?>
							<?php if (!empty($categories)): ?>
								<span class="sep"> | </span>
								<span class="cat-links">
									<?php foreach ($categories as $category): ?>
										<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name); ?></a>
									<?php endforeach; ?>
								</span>
							<?php endif; ?>
						</div>

						<h2 class="post-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" data-text="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
						</h2>

						<div class="post-excerpt">
							<?php the_excerpt(); ?>
						</div>

						<a class="post-read-more" href="<?php the_permalink(); ?>">
							<?php esc_html_e('Leer artículo', 'marcosdicapriodev'); ?><span aria-hidden="true">↗</span>
						</a>
					</div>
				</article>
			<?php endwhile; ?>

			<?php
			$pagination_links = paginate_links(array(
				'current' => $paged,
				'total' => $latest_posts->max_num_pages,
				'prev_text' => __('Anterior', 'marcosdicapriodev'),
				'next_text' => __('Siguiente', 'marcosdicapriodev'),
				'type' => 'array',
			));
			?>
			<?php if (!empty($pagination_links)): ?>
				<nav class="navigation pagination" aria-label="<?php esc_attr_e('Navegación de artículos', 'marcosdicapriodev'); ?>">
					<div class="nav-links"><?php echo wp_kses_post(implode('', $pagination_links)); ?></div>
				</nav>
			<?php endif; ?>
		<?php else: ?>
			<section class="no-results not-found">
				<header class="page-header">
					<h2 class="page-title"><?php esc_html_e('Nada encontrado', 'marcosdicapriodev'); ?></h2>
				</header>
				<div class="page-content">
					<p><?php esc_html_e('Parece que no podemos encontrar lo que buscas.', 'marcosdicapriodev'); ?></p>
				</div>
			</section>
		<?php endif; ?>
		</div>
	</section>
</main>

<?php
wp_reset_postdata();
get_footer();

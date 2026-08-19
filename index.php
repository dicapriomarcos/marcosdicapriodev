<?php get_header(); ?>

<main class="site-main site-main--archive">
	<?php if (is_home() && !is_paged()): ?>
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
	<?php endif; ?>

	<section class="archive-section" id="latest-posts" aria-labelledby="archive-title">
		<header class="section-heading">
			<p class="section-kicker"><?php esc_html_e('Cuaderno digital', 'marcosdicapriodev'); ?></p>
			<h2 id="archive-title"><?php echo is_home() ? esc_html__('Últimos artículos', 'marcosdicapriodev') : esc_html(get_the_archive_title()); ?></h2>
		</header>

		<div class="post-list">
		<?php if (have_posts()): ?>
			<?php while (have_posts()):
			the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
					<span class="post-index" aria-hidden="true"><?php echo esc_html(sprintf('%02d', $wp_query->current_post + 1)); ?></span>
					<div class="post-item__content">
					<div class="post-meta">
						<time datetime="<?php echo get_the_date('c'); ?>"><?php the_time(get_option('date_format')); ?></time>
						<span class="sep"> | </span>
						<span class="reading-time"><?php echo mdw_reading_time(); ?></span>
						<?php
						$categories = get_the_category();
						if (!empty($categories)): ?>
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
				
			<?php
	endwhile; ?>

			<?php
	the_posts_pagination(array(
		'prev_text' => __('Anterior', 'marcosdicapriodev'),
		'next_text' => __('Siguiente', 'marcosdicapriodev'),
	));
?>

		<?php
else: ?>
			
			<section class="no-results not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e('Nada encontrado', 'marcosdicapriodev'); ?></h1>
				</header>
				<div class="page-content">
					<p><?php _e('Parece que no podemos encontrar lo que buscas.', 'marcosdicapriodev'); ?></p>
				</div>
			</section>
			
		<?php
endif; ?>
		</div>
	</section>
</main>

<?php get_footer(); ?>

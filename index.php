<?php get_header(); ?>

<main class="site-main">
	<div class="post-list">
		<?php if (have_posts()): ?>
			<?php while (have_posts()):
		the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
					
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
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>

					<div class="post-excerpt">
						<?php the_excerpt(); ?>
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
</main>

<?php get_footer(); ?>

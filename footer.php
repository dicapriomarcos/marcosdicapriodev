<footer class="site-footer">
	<div class="site-footer__inner">
		<div class="footer-lead">
			<p><?php esc_html_e('Sigue explorando', 'marcosdicapriodev'); ?></p>
			<a class="footer-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
			<nav class="footer-legal-navigation" aria-label="<?php esc_attr_e('Enlaces legales', 'marcosdicapriodev'); ?>">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'footer_legal',
					'menu_class' => 'footer-legal-menu',
					'container' => false,
					'depth' => 1,
					'fallback_cb' => 'mdw_footer_legal_fallback',
				));
				?>
			</nav>
		</div>
		<div class="site-info">
			<span>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?></span>
			<a href="#top"><?php esc_html_e('Volver arriba', 'marcosdicapriodev'); ?> ↑</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

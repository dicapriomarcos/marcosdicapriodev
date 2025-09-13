<?php get_header(); ?>
<main class="md__main">
    <div class="md__container">
        <div class="md__posts-loop">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/post-loop'); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>

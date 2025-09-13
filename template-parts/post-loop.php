<article class="md__post post-id-<?php the_ID(); ?>">
    <h2><?php the_title(); ?></h2>
    <div class="md__post-meta">
        <?php _e('Publicado por', 'marcosdicapriodev'); ?> <?php the_author(); ?>
        <?php _e('Publicado el', 'marcosdicapriodev'); ?> <?php the_date(); ?>
    </div>
    <div class="md__post-content">
        <?php the_content(); ?>
    </div>

</article>

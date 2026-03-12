<?php
/**
 * Exclude Uncategorized (ID 1) category from displaying on the frontend
 */

function mdw_exclude_uncategorized_category($terms, $post_id, $taxonomy) {
    if (!is_admin() && $taxonomy === 'category') {
        if (is_array($terms)) {
            foreach ($terms as $key => $term) {
                if ($term->term_id == 1) {
                    unset($terms[$key]);
                }
            }
        }
    }
    return $terms;
}
add_filter('get_the_terms', 'mdw_exclude_uncategorized_category', 10, 3);

<?php
/**
 * Calculate estimated reading time
 */

function mdw_reading_time()
{
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average 200 words per minute

    if ($reading_time == 1) {
        $timer = " min";
    }
    else {
        $timer = " min";
    }

    return $reading_time . $timer . ' de lectura';
}

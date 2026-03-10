<?php
/**
 * Automatically Generate Table of Contents for Single Posts
 */

function mdw_add_toc_to_content($content)
{
    if (!is_single() || !in_the_loop() || is_main_query() === false) {
        return $content;
    }

    // Match all H2 and H3 tags
    preg_match_all('/<h([2-3])(.*?)>(.*?)<\/h[2-3]>/i', $content, $matches);

    if (empty($matches[0]) || count($matches[0]) < 2) {
        return $content; // Only show TOC if there are 2 or more headings
    }

    $toc = '<div class="mdw-toc"><h2>Tabla de Contenidos</h2><ul>';
    $current_level = 2;
    $counter = 1;

    foreach ($matches[0] as $i => $match) {
        $level = $matches[1][$i];
        $attributes = $matches[2][$i];
        $title = strip_tags($matches[3][$i]);
        $slug = sanitize_title($title) . '-' . $counter; // Ensure unique ID

        // Add ID to the heading in the content
        $new_heading = "<h{$level}{$attributes} id=\"{$slug}\">{$matches[3][$i]}</h{$level}>";
        $content = str_replace($match, $new_heading, $content);

        // Handle nested lists for H3
        if ($level > $current_level) {
            $toc .= '<ul>';
        }
        elseif ($level < $current_level) {
            $toc .= '</ul></li>';
        }
        elseif ($i > 0) {
            $toc .= '</li>';
        }

        $toc .= '<li><a href="#' . esc_attr($slug) . '">' . esc_html($title) . '</a>';

        $current_level = $level;
        $counter++;
    }

    // Close any remaining open lists
    while ($current_level > 2) {
        $toc .= '</ul></li>';
        $current_level--;
    }

    $toc .= '</li></ul></div>';

    return $toc . $content;
}
add_filter('the_content', 'mdw_add_toc_to_content');

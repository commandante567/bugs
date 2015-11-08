<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/utils.php',                 // Utility functions
  'lib/init.php',                  // Initial theme setup and constants
  'lib/wrapper.php',               // Theme wrapper class
  'lib/conditional-tag-check.php', // ConditionalTagCheck class
  'lib/config.php',                // Configuration
  'lib/assets.php',                // Scripts and stylesheets
  'lib/titles.php',                // Page titles
  'lib/extras.php',                // Custom functions
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


class Five_Sublevel_Walker extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu container'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}


/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2015.05.21
*/
function dimox_breadcrumbs() {

 /* === ОПЦИИ === */
 $text['home'] = 'Главная'; // текст ссылки "Главная"
 $text['category'] = 'Архив рубрики "%s"'; // текст для страницы рубрики
 $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
 $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
 $text['author'] = 'Статьи автора %s'; // текст для страницы автора
 $text['404'] = 'Ошибка 404'; // текст для страницы 404
 $text['page'] = 'Страница %s'; // текст 'Страница N'
 $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

 $delimiter = '›'; // разделитель между "крошками"
 $delim_before = '<span class="divider">'; // тег перед разделителем
 $delim_after = '</span>'; // тег после разделителя
 $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
 $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
 $show_title = 1; // 1 - показывать подсказку (title) для ссылок, 0 - не показывать
 $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
 $before = '<span class="current">'; // тег перед текущей "крошкой"
 $after = '</span>'; // тег после текущей "крошки"
 /* === КОНЕЦ ОПЦИЙ === */

 global $post;
 $home_link = home_url('/');
 $link_before = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
 $link_after = '</span>';
 $link_attr = ' itemprop="url"';
 $link_in_before = '<span itemprop="title">';
 $link_in_after = '</span>';
 $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
 $frontpage_id = get_option('page_on_front');
 $parent_id = $post->post_parent;
 $delimiter = ' ' . $delim_before . $delimiter . $delim_after . ' ';

 if (is_home() || is_front_page()) {

 if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

 } else {

 echo '<div class="breadcrumbs">';
 if ($show_home_link == 1) echo sprintf($link, $home_link, $text['home']);

 if ( is_category() ) {
 $cat = get_category(get_query_var('cat'), false);
 if ($cat->parent != 0) {
 $cats = get_category_parents($cat->parent, TRUE, $delimiter);
 $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
 $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
 if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
 if ($show_home_link == 1) echo $delimiter;
 echo $cats;
 }
 if ( get_query_var('paged') ) {
 $cat = $cat->cat_ID;
 echo $delimiter . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
 } else {
 if ($show_current == 1) echo $delimiter . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
 }

 } elseif ( is_search() ) {
 if ($show_home_link == 1) echo $delimiter;
 echo $before . sprintf($text['search'], get_search_query()) . $after;

 } elseif ( is_day() ) {
 if ($show_home_link == 1) echo $delimiter;
 echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
 echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
 echo $before . get_the_time('d') . $after;

 } elseif ( is_month() ) {
 if ($show_home_link == 1) echo $delimiter;
 echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
 echo $before . get_the_time('F') . $after;

 } elseif ( is_year() ) {
 if ($show_home_link == 1) echo $delimiter;
 echo $before . get_the_time('Y') . $after;

 } elseif ( is_single() && !is_attachment() ) {
 if ($show_home_link == 1) echo $delimiter;
 if ( get_post_type() != 'post' ) {
 $post_type = get_post_type_object(get_post_type());
 $slug = $post_type->rewrite;
 printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
 if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
 } else {
 $cat = get_the_category(); $cat = $cat[0];
 $cats = get_category_parents($cat, TRUE, $delimiter);
 if ($show_current == 0 || get_query_var('cpage')) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
 $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
 if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
 echo $cats;
 if ( get_query_var('cpage') ) {
 echo $delimiter . sprintf($link, get_permalink(), get_the_title()) . $delimiter . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
 } else {
 if ($show_current == 1) echo $before . get_the_title() . $after;
 }
 }

 // custom post type
 } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
 $post_type = get_post_type_object(get_post_type());
 if ( get_query_var('paged') ) {
 echo $delimiter . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
 } else {
 if ($show_current == 1) echo $delimiter . $before . $post_type->label . $after;
 }

 } elseif ( is_attachment() ) {
 if ($show_home_link == 1) echo $delimiter;
 $parent = get_post($parent_id);
 $cat = get_the_category($parent->ID); $cat = $cat[0];
 if ($cat) {
 $cats = get_category_parents($cat, TRUE, $delimiter);
 $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
 if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
 echo $cats;
 }
 printf($link, get_permalink($parent), $parent->post_title);
 if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

 } elseif ( is_page() && !$parent_id ) {
 if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

 } elseif ( is_page() && $parent_id ) {
 if ($show_home_link == 1) echo $delimiter;
 if ($parent_id != $frontpage_id) {
 $breadcrumbs = array();
 while ($parent_id) {
 $page = get_page($parent_id);
 if ($parent_id != $frontpage_id) {
 $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
 }
 $parent_id = $page->post_parent;
 }
 $breadcrumbs = array_reverse($breadcrumbs);
 for ($i = 0; $i < count($breadcrumbs); $i++) {
 echo $breadcrumbs[$i];
 if ($i != count($breadcrumbs)-1) echo $delimiter;
 }
 }
 if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

 } elseif ( is_tag() ) {
 if ($show_current == 1) echo $delimiter . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

 } elseif ( is_author() ) {
 if ($show_home_link == 1) echo $delimiter;
 global $author;
 $author = get_userdata($author);
 echo $before . sprintf($text['author'], $author->display_name) . $after;

 } elseif ( is_404() ) {
 if ($show_home_link == 1) echo $delimiter;
 echo $before . $text['404'] . $after;

 } elseif ( has_post_format() && !is_singular() ) {
 if ($show_home_link == 1) echo $delimiter;
 echo get_post_format_string( get_post_format() );
 }

 echo '</div><!-- .breadcrumbs -->';

 }
} // end dimox_breadcrumbs()



 add_filter("child-pages-shortcode-template", "my_template");
    function my_template($template) {
        return '<div id="child_page-%post_id%" class="child_page">
                    <div class="child_page-container">
                        <div class="post_thumb"><a href="%post_url%">%post_thumb%</a></div>
                        <div class="post_content">
                            <h3><a href="%post_url%">%post_title%</a></h3>
                        </div>
                    </div>
                </div>';
    }

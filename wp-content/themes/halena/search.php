<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Agni Framework
 */

get_header(); 

do_action( 'agni_posts_init', '', $archive = true, $shortcode = false ); 

get_footer(); ?>

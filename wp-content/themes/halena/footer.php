<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Agni Framework
 */

?>
	</div><!-- #content -->
	<?php agni_footer(); ?>
</div><!-- #page -->
<?php do_action( 'agni_popup_box' ); ?>
<?php agni_preloader(); ?>

<?php wp_footer(); ?>
</body>
</html>

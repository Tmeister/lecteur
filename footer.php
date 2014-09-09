<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Lecteur
 */

$footer = get_theme_mod('lecteur_logo_footer');
$style = ( $footer ) ? 'style="background-image: url('.$footer.');"' : '';

?>
		<div class="clear"></div>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="holder" <?php echo $style ?><?php echo $style ?>>
				Copyright &copy; 2014 <a href="#">Enrique Chavez</a>.<br>
				12345 Fake Street. // Some Place, CA // 90210.<br>
				123.456.7890
			</div>
		</footer><!-- #colophon -->
	</div><!-- #content -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
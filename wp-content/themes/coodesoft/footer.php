<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php wp_footer(); ?>

<div class="coode_footer">
    <div class="coode_footer_title">También nos podes encontrar en</div>
    <div class="coode_footer_content">
        <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
    </div>
    <div class="coode_footer_info">
        Tema: Coode - desarrollado por <a href="https://coodesoft.com.ar">Coodesoft</a>
    </div>
</div>



</body>
</html>

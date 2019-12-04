<div id="posts-container" class="fusion-blog-archive <?php echo esc_attr( $wrapper_class ); ?>fusion-clearfix">
	<div class="<?php echo esc_attr( $container_class ); ?>" data-pages="<?php echo (int) $number_of_pages; ?>">
		<?php if ( 'timeline' === $blog_layout ) : ?>
			<?php // Add the timeline icon. ?>
			<div class="fusion-timeline-icon"><i class="fusion-icon-bubbles"></i></div>
			<div class="fusion-blog-layout-timeline fusion-clearfix">

			<?php
			// Initialize the time stamps for timeline month/year check.
			$post_count = 1;
			$prev_post_timestamp = null;
			$prev_post_month = null;
			$prev_post_year = null;
			$first_timeline_loop = false;
			?>

			<?php // Add the container that holds the actual timeline line. ?>
			<div class="fusion-timeline-line"></div>
		<?php endif; ?>

		<?php if ( 'masonry' === $blog_layout ) : ?>
			<article class="fusion-post-grid fusion-post-masonry post fusion-grid-sizer"></article>
		<?php endif; ?>

    <?php // Start the main loop. ?>
<?php while ( have_posts() ) : the_post(); ?>
  <?php
  // Set the time stamps for timeline month/year check.
  $alignment_class = '';
  if ( 'timeline' === $blog_layout ) {
    $post_timestamp = get_the_time( 'U' );
    $post_month     = date( 'n', $post_timestamp );
    $post_year      = get_the_date( 'Y' );
    $current_date   = get_the_date( 'Y-n' );
    // Set the correct column class for every post.
    if ( $post_count % 2 ) {
      $alignment_class = 'fusion-left-column';
    } else {
      $alignment_class = 'fusion-right-column';
    }

    // Set the timeline month label.
    if ( $prev_post_month != $post_month || $prev_post_year != $post_year ) {

      if ( $post_count > 1 ) {
        echo '</div>';
      }
      echo '<h3 class="fusion-timeline-date">' . get_the_date( Avada()->settings->get( 'timeline_date_format' ) ) . '</h3>';
      echo '<div class="fusion-collapse-month">';
    }
  }

<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPressdotorg\Pattern_Directory\Theme
 */

namespace WordPressdotorg\Pattern_Directory\Theme;

get_header();

$user_has_reported = is_user_logged_in() ? user_has_flagged_pattern() : false;

?>
	<input id="block-data" type="hidden" value="<?php echo rawurlencode( wp_json_encode( get_the_content() ) ); ?>" />
	<main id="main" class="site-main col-12" role="main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<p>A large hero section with an example background image and a heading in the center.</p>
					<div id="pattern-actions" class="pattern-actions" data-id="<?php the_ID(); ?>">
						<button class="button button-primary">Copy Pattern</button>
						<button class="button">Add to favorites</button>
					</div>
				</header><!-- .entry-header -->

				<div class="pattern-preview__container" hidden>
					<?php echo rawurlencode( wp_json_encode( get_the_content() ) ); ?>
				</div>

				<div class="pattern__meta">
					<div>
						<div class="pattern__categories">
							<?php
							$categories_list = get_the_term_list( get_the_ID(), 'wporg-pattern-category', '', ', ' );
							if ( $categories_list ) {
								/* translators: 1: list of pattern categories. */
								printf( esc_html__( 'Categories: %1$s', 'wporg-patterns' ), $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
							?>
						</div>
						<div id="pattern-report"
							class="pattern__report"
							data-post-id="<?php echo intval( get_the_ID() ); ?>"
							data-logged-in="<?php echo json_encode( is_user_logged_in() ); ?>"
							data-user-has-reported="<?php echo json_encode( $user_has_reported ); ?>"
							">
							<button class="button">Report this pattern</button>
						</div>
					</div>
				</div>

				<div class="entry-content">
					<h2>More from this designer</h2>
					<div class="pattern-grid">
						<ul>
							<li>Pattern A</li>
							<li>Pattern B</li>
							<li>Pattern C</li>
						</ul>
					</div>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->

		<?php endwhile; ?>

	</main><!-- #main -->

<?php
get_footer();

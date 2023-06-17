<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme;

get_header();
?>
    <main class="site-main content-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="<?php Helper::the_layout_class(); ?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content', 'page' ); ?>
					<?php endwhile; ?>
                </div>
				<?php
				if ( Helper::has_sidebar() ) {
					get_sidebar();
				}
				?>
            </div>
        </div>
    </main>
	<?php get_footer();
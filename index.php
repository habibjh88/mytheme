<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme;

get_header();
?>
    <main class="site-main blog-grid blog-grid-inner content-area rtcl-widget-border-enable rtcl-widget-is-sticky">
        <div class="container">
            <div class="row">
                <div class="<?php Helper::the_layout_class(); ?>">
                    <div class="main-post-content">
						<?php if ( have_posts() ) : ?>
							<?php
								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content' );
								endwhile;
							?>
						<?php else: ?>
							<?php get_template_part( 'template-parts/content', 'none' ); ?>
						<?php endif; ?>
                    </div>

					<?php
					if ( MyTheme::$options['blog_related_posts'] ) {
						get_template_part( 'template-parts/pagination' );
					}
					?>
                </div>
				<?php
				if ( Helper::has_sidebar() ) {
					get_sidebar();
				}
				?>
            </div>
        </div>
    </main>

<?php
get_footer();
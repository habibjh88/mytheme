<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\MyTheme;
?>
<div class="page-content-block">
    <div class="main-content">
        <div class="page-content-inner clearfix">

            <!--TODO: Listing Title Condition may be change -->
			<?php if ( MyTheme::$options['breadcrumb_title'] !== 'mytheme-page-title' ) : ?>
                <div class='page-title-wrap'><h2 class="page-title"><?php the_title(); ?></h2></div>
			<?php endif; ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( has_post_thumbnail() ): ?>
                    <div class="main-thumbnail"><?php the_post_thumbnail(); ?></div>
				<?php endif; ?>
				<?php the_content(); ?>
            </div>
        </div>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
        <div class="page-pagination">
			<?php wp_link_pages(); ?>
        </div>
    </div>
</div>
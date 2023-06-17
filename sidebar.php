<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme;
?>
<div id="sticky_sidebar" class="<?php Helper::the_sidebar_class(); ?>">
	<?php
	if ( MyTheme::$sidebar && is_active_sidebar( MyTheme::$sidebar ) ) { ?>
        <aside class="sidebar-widget main-sidebar-wrapper">
            <?php dynamic_sidebar( MyTheme::$sidebar ); ?>
        </aside>
    <?php
	} elseif( is_active_sidebar( 'sidebar' ) ) { ?>
        <aside class="sidebar-widget main-sidebar-wrapper sidebar__inner">
			<?php dynamic_sidebar( 'sidebar' ); ?>
        </aside>
		<?php
	}
	?>
</div>
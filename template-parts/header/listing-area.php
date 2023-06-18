<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

use MyTheme\MyTheme;

$login_icon_title = is_user_logged_in() ? esc_html__( " My Account", 'mytheme' ) : esc_html__( " Sign in", 'mytheme' );
?>

<div class="listing-area">
    <div class="header-action">
        <ul class="header-btn">

                <li class="login-btn button">
                    <a class="item-btn"
                       data-toggle="tooltip"
                       data-placement="bottom"
                       title="<?php echo esc_attr( $login_icon_title ); ?>"
                       href="#">
                        <i class="flaticon-user-1 icon-round"></i>
                    </a>
                </li>


			<?php
			if ( MyTheme::$options['header_cart_icon'] && class_exists( 'WC_Widget_Cart' ) ) {
				if ( MyTheme::$options['cart_btn_order'] ) {
					$cart_btn_order = "order:" . MyTheme::$options['cart_btn_order'];
				} elseif ( MyTheme::$header_style == "2" ) {
					$cart_btn_order = "order:4";
				} else {
					$cart_btn_order = "";
				}
				echo "<li class='cart-icon button icon-hover-item' style='" . esc_attr( $cart_btn_order ) . "'>";
				get_template_part( 'template-parts/header/cart', 'icon' );
				echo "</li>";
			}
			?>

            <?php
			if ( MyTheme::$options['header_search_icon'] ) {
				if ( MyTheme::$options['search_btn_order'] ) {
					$search_btn_order = "order:" . MyTheme::$options['search_btn_order'];
				} elseif ( MyTheme::$header_style == "2" ) {
					$search_btn_order = "order:5";
				} else {
					$search_btn_order = "";
				}
				?>
                <li class="search-icon button icon-hover-item" style="<?php echo esc_attr( $search_btn_order ) ?>">
	                <?php get_template_part( 'template-parts/header/search', 'icon' ); ?>
<!--                    <a class="item-btn"-->
<!--                       data-toggle="tooltip"-->
<!--                       data-placement="bottom"-->
<!--                       title="--><?php //echo esc_attr( 'Search', 'mytheme' ); ?><!--"-->
<!--                       href="--><?php //echo esc_url( Link::get_my_account_page_link() ); ?><!--">-->
<!--                        <i class="fas fa-search icon-round"></i>-->
<!--                    </a>-->
                </li>
            <?php
			}
			?>

			<?php if ( MyTheme::$options['header_btn'] ):
				if ( MyTheme::$options['header_btn_order'] ) {
					$header_btn_order = "order:" . MyTheme::$options['header_btn_order'];
				} elseif ( MyTheme::$header_style == "2" ) {
					$header_btn_order = "order:4";
				} else {
					$header_btn_order = "";
				}
				?>
                <li class="submit-btn header-add-property-btn" style="<?php echo esc_attr( $header_btn_order ); ?>">
                    <a href="<?php echo esc_url( MyTheme::$options['header_btn_url'] ); ?>" class="item-btn rt-animation-btn">
						<span>
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <div class="btn-text"><?php echo esc_html( MyTheme::$options['header_btn_txt'] ); ?></div>
                    </a>
                </li>
			<?php endif; ?>

            <li class="offcanvar_bar button" style="order: 99">
                <span class="sidebarBtn ">
                    <span class="fa fa-bars">
                    </span>
                </span>
            </li>
        </ul>
    </div>
</div>

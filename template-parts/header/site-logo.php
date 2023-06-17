<?php

use MyTheme\Helper;
use MyTheme\MyTheme;

$custom_logo_id = get_theme_mod( 'custom_logo' );
$default_logo_name = MyTheme::$has_tr_header ? "logo_light.svg" : "logo.svg";
$default_logo = $custom_logo_id ? wp_get_attachment_image_src( $custom_logo_id, 'full' ) : [
	Helper::get_img( $default_logo_name ),
	157,
	40
];
$main_logo = ( isset( MyTheme::$options['logo'] ) && 0 != MyTheme::$options['logo'] ) ? wp_get_attachment_image_src( MyTheme::$options['logo'], 'full' ) : $default_logo;
$light_logo = ( isset( MyTheme::$options['logo_light'] ) && 0 != MyTheme::$options['logo_light'] ) ? wp_get_attachment_image_src( MyTheme::$options['logo_light'], 'full' )
	: $default_logo;

if ( ( isset( MyTheme::$options['logo'] ) && 0 != MyTheme::$options['logo'] ) && ! ( isset( MyTheme::$options['logo_light'] ) && 0 != MyTheme::$options['logo_light'] ) ) {
	$light_logo = $main_logo;
}

if ( ! ( isset( MyTheme::$options['logo'] ) && 0 != MyTheme::$options['logo'] ) && ( isset( MyTheme::$options['logo_light'] ) && 0 != MyTheme::$options['logo_light'] ) ) {
	$main_logo = $light_logo;
}

if ( MyTheme::$has_tr_header ) {
	$logo = $light_logo;
} else {
	$logo = $main_logo;
}
?>

<div class="logo-area">
    <div class="site-branding">
		<?php if ( ! empty( $logo ) ): ?>
            <a class="custom-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img class="img-fluid" src="<?php echo esc_url( $logo[0] ); ?>"
                     width="<?php echo esc_attr( $logo[1] ); ?>"
                     height="<?php echo esc_attr( $logo[2] ); ?>"
                     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                >
            </a>
		<?php else: ?>
            <h1 class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'mytheme' ); ?>" rel="home">
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                </a>
            </h1>
		<?php endif; ?>
    </div>
</div>
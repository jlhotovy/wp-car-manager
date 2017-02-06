<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
$thispost = get_the_ID();
?>

<div class="wpcm-contact">
	<?php
	if ( '' != $email && apply_filters( 'wpcm_contact_email_link', TRUE ) ) :
		?>
		<h1 class="contact-seller">Contact the seller</h1>
		<?php echo do_shortcode( '[ninja_form id=6]' ); ?>
	<?php endif; ?>

	<?php
	$phone_number = wp_car_manager()->service( 'settings' )->get_option( 'contact_phone' );
	if ( '' !== $phone_number ) :
		?>
		<a href="tel:<?php echo esc_attr( $phone_number ); ?>"
		   class="wpcm-button wpcm-contact-button"><?php _e( 'Call Us', 'wp-car-manager' ); ?></a>
	<?php endif; ?>

</div>

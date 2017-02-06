<?php

function my_theme_enqueue_styles() {
    $parent_style = 'parent-style'; // This is 'twentyseventeen-style' for the Twenty seventeen theme.
    wp_enqueue_style( 'child-style',  get_stylesheet_directory_uri() .'/style.css', array(), false, 'all' );

//    $version = NULL; 
//    if (!defined('WP_DEBUG') || true !== WP_DEBUG) {
//      $version = wp_get_theme()->get('Version');
//    }  
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
//    wp_enqueue_style( 'child-style',
//        get_stylesheet_directory_uri() . '/style.css',
//        array( $parent_style ),
//        $version
//        wp_get_theme()->get('Version')
//    );
}
// wp_enqueue_script() TODOs
function my_theme_enqueue_scripts() {
    wp_enqueue_script('roi-js', get_stylesheet_directory_uri() . '/roi.js', array( 'jquery' ), false); 
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts' );

//JLH
// Testing function to display variable values * - use d($variablename) for display in debug mode 
 function d($var, $tags = null) {
   if (!defined('WP_DEBUG') || true !== WP_DEBUG) {
     return;
   }
   if ( is_array( $var ) || is_object( $var ) ) {
     error_log( print_r( $var, true ) );
   } else {
     error_log( $var );
   }
   // $backtrace = print_r(debug_backtrace(), true);
   PhpConsole\Connector::getInstance()->getDebugDispatcher()->dispatchDebug($var, $tags, 1);
   // PhpConsole\Connector::getInstance()->getDebugDispatcher()->dispatchDebug($backtrace, $tags, 1);
}
d('debug is on');

/*
  Get the author's email address from the author meta infos.
*/
function custom_get_post_author_email($atts){
  $value = '';
  if(get_the_author_meta( 'user_email' )) {
    $value = get_the_author_meta( 'user_email' );
  }
//  d($value);
  return $value;
}
add_shortcode('seller_email', 'custom_get_post_author_email');

//to add registration hooks to auto save a new user and login a new user
add_action( 'user_register', 'myplugin_registration_save', 10, 1 );
function myplugin_registration_save( $user_id ) {
    $location = home_url()."/?pb_autologin=true&pb_uid=$user_id";
//    d($location);
    echo "<script> window.location.replace('$location'); </script>";
}
add_action( 'init', 'wppb_custom_autologin' );
function wppb_custom_autologin(){
    $url = 'sell-my-car';
    if( isset( $_GET['pb_autologin'] ) && isset( $_GET['pb_uid'] )  ){
        $uid = $_GET['pb_uid'];
        wp_set_auth_cookie( $uid );
        delete_user_meta($uid, 'pb_autologin' . $uid );
        delete_user_meta($uid, 'pb_autologin' . $uid . '_expiration');
        wp_redirect( $url );
        exit;
    }
}
// WP Car Manager change some strings
function wpcm_change_some_words( $translated, $text, $domain ) {

if ( 'wp-car-manager' == $domain ) {
  if ( 'First Registration Date' == $text ) {
     $translated = 'Year';
   } else if ( 'First Registration Date' == $text ) {
     $translated = 'Year';
   }
}
return $translated;
}
add_filter( 'gettext', 'wpcm_change_some_words', 10, 4 );
 
 // JLH WP Car Manager Change selected post meta data before persisting to data based
function ROI_update_post_metadata($null, $post_id, $meta_key, $meta_value, $prev_value) {
    $doors = NULL;
    if ('wpcm_doors' == $meta_key && $doors !== $meta_value) {
        // d("ROI_update_post_metadata::update_post_meta(NULL), return 1"); 
        update_post_meta($post_id, $meta_key, $doors);
        return 1;
    }  
    $transmission = NULL;
    if ('wpcm_transmission' == $meta_key && $transmission !== $meta_value ) {
        update_post_meta($post_id, $meta_key, $transmission);
        return 1;
    }
    $condition = 'used';
    if ('wpcm_condition' == $meta_key && $condition != $meta_value) {
        update_post_meta($post_id, $meta_key, $condition);
        return 1;
    }
    return NULL;
}

add_filter( 'update_post_metadata', 'ROI_update_post_metadata', 10, 5); 
//JLH
 ?>
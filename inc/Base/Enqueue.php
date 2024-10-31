<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Base;

class Enqueue extends BaseController {
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'front_enqueue' ) );
	}

	public function admin_enqueue() {
		//admin enqueue scripts
		wp_enqueue_style( 'rdextkc_fontawesome_load_admin', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );

		wp_enqueue_style( 'rdextkc_admin_css', $this->plugin_url . 'assets/css/adminstyle.css' );

		wp_enqueue_script( 'rdextkc-admin-js', $this->plugin_url . 'assets/js/adminscript.min.js', array( 'jquery' ), '', true );

	}

	//wp/front enqueue scripts
	public function front_enqueue() {
		wp_enqueue_style( 'rdextkc_bootstrap_load', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' );
		wp_enqueue_style( 'rdextkc_fontawesome_load', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'rdextkc-extensions-css', $this->plugin_url . 'assets/css/extensions.min.css' );

		wp_enqueue_script( 'rdextkc-testimonial-js', $this->plugin_url . 'assets/js/jquery.bxslider.min.js', array( 'jquery' ), '', false );

		wp_enqueue_script( 'rdextkc-extensions-js', $this->plugin_url . 'assets/js/extensions.min.js', array( 'jquery' ), '', true );
	}
}
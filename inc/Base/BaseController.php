<?php
/**
 * @package  RdExtKc
 */
namespace Rdextkc\Base;

class BaseController {
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $shortcodes = array();

	//For PHP Lower Version - Get Path
	public function prime_dirname( $path, $count = 1 ) {
		if ( $count > 1 ) {
			return dirname( $this->prime_dirname( $path, -- $count ) );
		} else {
			return dirname( $path );
		}
	}


	public function __construct() {
		$this->plugin_path = plugin_dir_path( $this->prime_dirname( __FILE__, 2 ) );
		$this->plugin_url  = plugin_dir_url( $this->prime_dirname( __FILE__, 2 ) );
		$this->plugin      = plugin_basename( $this->prime_dirname( __FILE__, 3 ) ) . '/rd-extensions-bundle-kingcomposer.php';

		/*-----------------------------------------------------------------------------------*/
		/*	Initalising Shortcodes In Content and Widget
		/*-----------------------------------------------------------------------------------*/
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'the_content', 'do_shortcode' );
		add_filter( 'the_excerpt', 'do_shortcode' );


		$this->shortcodes = array(
			'icon_animation' => 'Icon Animation',
			'before_after'   => 'Before After',
			'flipbox'        => 'FlipBox',
			'separator'        => 'Separator',
			'accordion'      => 'Accordion ',
			'animate_box'    => 'Animate Box',
			'hover_effects'  => 'Hover Effects',
			'info_box'       => 'Info Box',
			'modalbox'       => 'Modal Box',
			'pricing_table'  => 'Pricing Table',
			'testimonial'    => 'Testimonial',
			'servicebox'     => 'Service Box',
			'progressbar'     => 'Progress Bar'
		);
	}
}
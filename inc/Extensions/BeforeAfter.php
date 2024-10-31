<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Extensions;

use Rdextkc\Base\ExtensionsController;

class BeforeAfter extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'before_after' ) ) {
			return;
		}
		add_shortcode( 'rdextkc_beforeafter', array( $this, 'rdextkc_beforeafter_func' ) );


		add_action( 'init', array( $this, 'beforeafter' ) );
	}

	function beforeafter() {

		global $kc;
		$kc->add_map( array(
			'rdextkc_beforeafter' => array(
				'name'        => 'Image Before After',
				'description' => __( 'flexible image before after shortcode', 'kingcomposer' ),
				'icon'        => 'rdextkc_beforeafter_icon',
				'css_box'     => true,
				'category'    => 'RD Extensions',
				'params'      => array(
					array(
						'name'        => 'before_image',
						'label'       => 'Before Image',
						'type'        => 'attach_image',
						"description" => __( "Select image from media library for before.", "kingcomposer" ),
					),
					array(
						'name'        => 'after_image',
						'label'       => 'After Image',
						'type'        => 'attach_image',
						"description" => __( "Select image from media library for before.", "kingcomposer" ),
					),

					array(
						'name'    => 'on_click',
						'label'   => 'On Click',
						'type'    => 'select',
						'options' => array(
							'none' => 'Do Nothing',
							'box'  => 'Complete Box',
						),
					),

					array(
						'name'     => 'link',
						'label'    => 'Add Link',
						'type'     => 'link',
						'relation' => array(
							'parent'    => 'on_click',
							'show_when' => 'box',
						),
					),
					array(
						'type'        => 'text',
						'label'       => __( 'Extra class name', 'kingcomposer' ),
						'name'        => 'extraclass',
						'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'kingcomposer' ),
					),


				),
			),
		) );
	}


	// Register Before After Shortcode
	function rdextkc_beforeafter_func( $atts, $content = null ) {
		extract( shortcode_atts( array(

			'before_image' => '',
			'after_image'  => '',
			'on_click'     => '',
			'link'         => '',
			'extraclass'   => '',

		), $atts ) );


		//wp_register_style('akc_ba_css', plugins_url( 'css/before-after.css' , __FILE__ ) );
		//wp_register_script('akc_event_move', plugins_url('js/jquery.event.move.js', __FILE__), array('jquery'), '', false);
		//wp_register_script('akc_twentytwenty_js', plugins_url('js/jquery.twentytwenty.js', __FILE__), array('jquery'), '', false );
		//wp_enqueue_style( 'akc_ba_css' );
		//wp_enqueue_script( 'akc_event_move' );
		//wp_enqueue_script( 'akc_twentytwenty_js' );

		$before_image = wp_get_attachment_image_src( $before_image, 'full' );
		$after_image  = wp_get_attachment_image_src( $after_image, 'full' );
		$link         = kc_parse_link( $link );
		$output       = '';

		$id = rand( 1, 10000000 );

		if ( $on_click == 'box' ) {
			$output = '<a class="href" href="' . $link['url'] . '" title="' . $link['title'] . '" target="' . $link['target'] . '">';
		}

		$output .= '<div class="' . $extraclass . '" id="container_' . $id . '">
                        <img src="' . $before_image[0] . '">
                        <img src="' . $after_image[0] . '">
                    </div>';

		if ( $on_click == 'box' ) {
			$output .= '</a>';
		}

		$output .= '<script>
                        jQuery(window).load(function() {
                            jQuery("#container_' . $id . '").twentytwenty();
                        });
                    </script>';

		return $output;
	}
}
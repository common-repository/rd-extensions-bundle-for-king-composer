<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Extensions {

	use Rdextkc\Base\ExtensionsController;

	class Separator extends ExtensionsController {

		public function extensions_register() {

			if ( ! $this->activated( 'separator' ) ) {
				return;
			}
			add_shortcode( 'rdextkc_separator', array( $this, 'rdextkc_separator_func' ) );
			add_action( 'init', array( $this, 'separator' ) );

		}

		public function separator() {
			global $kc;
			$kc->add_map( array(
				'rdextkc_separator' => array(
					'name'        => 'Separator',
					'description' => __( 'Add Space/Separator', 'rdextkc' ),
					'icon'        => 'rdextkc_separator_icon',
					'css_box'     => true,
					'category'    => 'RD Extensions',
					'params'      => array(
						array(
							"type"        => "text",
							"label"       => __( "Height Space", 'rdextkc' ),
							"name"        => "height",
							"admin_label" => true,
							"description" => "Ex: 100px",
							"value"       => "300px",
						)

					),
				),
			) );
		}

		// Register Before After Shortcode
		function rdextkc_separator_func( $atts, $content = null, $tag ) {
			extract(
				shortcode_atts(
					array(
						"height" => '300px',
					),
					$atts)
			);

			$output = '<div class="rdextkc-space" style="height:'.$height.'"></div>';

			return $output;
		}
	}

}
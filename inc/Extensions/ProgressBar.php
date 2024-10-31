<?php
/**
 * @package  RdExtKc
 */
namespace Rdextkc\Extensions {

	use Rdextkc\Base\ExtensionsController;

	class ProgressBar extends ExtensionsController {

		public function extensions_register() {

			if ( ! $this->activated( 'progressbar' ) ) {
				return;
			}
			add_shortcode( 'rdextkc_preloader', array( $this, 'rdextkc_preloader_func' ) );
			add_action( 'init', array( $this, 'progressbar' ) );

		}

		public function progressbar() {
			global $kc;
			$kc->add_map( array(
				'rdextkc_preloader' => array(
					'name'        => 'Progress Bar',
					'description' => __( 'Add Space/Separator', 'rdextkc' ),
					'icon'        => 'rdextkc_progressbar_icon',
					'css_box'     => true,
					'category'    => 'RD Extensions',
					'params'      => array(
				'general' => array(
						array(
							"type"        => "text",
							/*"holder" => "div",*/
							"class"       => "",
							"label"     => __( "Bar Label", 'rdext_vc' ),
							"name"  => "bar_label",
							"value"       => "Label Here",
							/*"description" => __("Provide the title for the iHover.", 'ultimate')*/
						),


						// TItle Font Size Field
						array(
							'type'        => 'number_slider',
							'label'     => __( 'Bar percentage', 'rdext_vc' ),
							'name'  => 'bar_percentage',
							'options' => array(    // REQUIRED
								'min' => 1,
								'max' => 100,
								'unit' => '%',
								'show_input' => true
							),
							'value'			=> '95',
							"description" => __( "Chose Bar percentage.", "rdext_vc" ),
						),
					),
						'Bar Option' => array(
						array(
							"type"        => "select",
							"label"     => __( "Progress Bar Style" ),
							"name"  => "bar_style",
							"admin_label" => true,
							"options"       => array(
								'style1'  => 'Style 1',
								'style2'  => 'Style 2',
								'style3' => 'Style 3',
								'style4' => 'Style 4',
								'style5'  => 'Style 5',
								'style6'  => 'Style 6',
								'style7'  => 'Style 7',
								'style8'  => 'Style 8',
								'style9'  => 'Style 9',
								'style10'  => 'Style 10'
							),
							'description' => 'Select Progress Bar Style here, Default is Style 1',
						),

						array(
							"type"        => "select",
							"label"     => __( "Progress Bar Effects" ),
							"name"  => "bar_effects",
							"admin_label" => true,
							"options"       => array(
								'success'  => 'Normal',
								'striped'  => 'Striped',
								'striped active' => 'Animate',
							),
							'description' => 'Select Progress Bar Effects here, Default Is Normal ',
						),
						),

					'Typography' => array(
						// Background Color
						array(
							"type"        => "color_picker",
							"class"       => "",
							"label"     => __( "Bar Background color", "rdext_vc" ),
							"name"  => "bar_bg_color",
							"value"       => '#16a085', //Default Red color
							"description" => __( "Choose text color", "rdext_vc" ),
						),
						array(
							"type"        => "text",
							"label"     => __( "Margin Top", 'rdext_vc' ),
							"name"  => "margin_top",
							"admin_label" => true,
							"value"       => "20",
						),
						array(
							"type"        => "text",
							"label"     => __( "Margin Bottom", 'rdext_vc' ),
							"name"  => "margin_bottom",
							"admin_label" => true,
							"value"       => "40",
						),

						),

					),
				),
			) );
		}

		// Register Before After Shortcode
	function rdextkc_preloader_func( $atts, $content = null ) {
				extract( shortcode_atts( array(
					'bar_label'    => 'HTML',
					'bar_percentage'             => '95',
					'bar_style'             => 'style1',
					'bar_bg_color'             => '#337AB7',
					'margin_top'             => '20',
					'margin_bottom'             => '40',
					'bar_effects'             => 'success',
				), $atts ) );
				$output = '';

				$bar_percentage = isset($atts['bar_percentage']) != '' ? (int) esc_attr( $atts['bar_percentage'] ) : 95;
		$output .= '<div class="pev-progress-'.$bar_style.'" style="margin-bottom: '.$margin_bottom.'px; margin-top: '.$margin_top.'px;">
	          <div class="pev-progress-bar pev-progress-bar-'.$bar_effects.'" role="pev-progress-bar" aria-valuenow="'.$bar_percentage.'"
	                		  aria-valuemin="0" aria-valuemax="100" style="width:'.$bar_percentage.'%; background-color: '.$bar_bg_color.'">
	                		    <span class="pev-label">'.$bar_label.'</span>
	                		    <span class="pev-percent">'.$bar_percentage.'%</span>
	                		    
	                		  </div>
	                		</div>';


				return $output;
			}
	}

}
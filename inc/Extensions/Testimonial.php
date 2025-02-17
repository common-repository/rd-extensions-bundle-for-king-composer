<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Extensions {

	use Rdextkc\Base\ExtensionsController;

	class Testimonial extends ExtensionsController {

		public function extensions_register() {

			if ( ! $this->activated( 'testimonial' ) ) {
				return;
			}
			add_shortcode( 'rdextkc_testimonial', array( $this, 'rdextkc_testimonial_func' ) );
			add_action( 'init', array( $this, 'testimonial' ) );

		}

		public function testimonial() {
			global $kc;
			$kc->add_map( array(
					'rdextkc_testimonial' => array(
						'name'        => 'Testimonial',
						'description' => __( 'Awesome Testimonial Item You Can Add in your Wordpress', 'KingComposer' ),
						'icon'        => 'rdextkc_testimonial_icon',
						'css_box'     => true,
						'category'    => 'RD Extensions',
						'params'      => array(
							// General Group Start
							'Add Items' => array(
								array(
									'type'        => 'group',
									'label'       => __( 'Add Testimonial Items', 'KingComposer' ),
									'name'        => 'acoptions',
									'description' => __( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer' ),
									'options'     => array( 'add_text' => __( 'Add new items', 'kingcomposer' ) ),
									/*        // default values when create new group
											'value' => base64_encode( json_encode( array(
												"1" => array(
													"title" => "default value 1 of group 1",
													"acc_descr" => "default value 2 of group 1"
												),
											))),*/

									'params' => array(
										array(
											'name'  => 'client_image',
											'label' => 'Upload Client Image',
											'type'  => 'attach_image',
										),
										array(
											'name'  => 'cl_name',
											'label' => 'Client Name',
											'type'  => 'text',
											'value' => __( 'Client Name Here', 'KingComposer' ),
										),
										array(
											'name'  => 'cl_label',
											'label' => 'Client Label',
											'type'  => 'text',
											'value' => __( 'Client Label here', 'KingComposer' ),
										),

										array(
											'type'        => 'textarea',
											'label'       => __( 'Testimonial Description', 'kingcomposer' ),
											'name'        => 'testi_descr',
											'description' => __( 'Description of the Testimonial.', 'kingcomposer' ),
											'admin_label' => true,
											'value'       => base64_encode( 'Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo.Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo' ),
										),

									),
								),
							),

							// General Group End

							'Setting' => array(
								array(
									'name'        => 'test_width',
									'label'       => 'Testimonial Width',
									'type'        => 'number_slider',
									'options'     => array(
										'min'        => 300,
										'max'        => 2000,
										'unit'       => '',
										'show_input' => true,
									),
									'value'       => 800,
									'description' => 'Use Custom Testimonial Slide Width, default is 800px',
								),
								array(
									'name'        => 'test_margin',
									'label'       => 'Testimonial Margin',
									'type'        => 'number_slider',
									'options'     => array(
										'min'        => 5,
										'max'        => 100,
										'unit'       => '',
										'show_input' => true,
									),
									'value'       => 32,
									'description' => 'Use Custom Testimonial Slide Margin, default is 32px',
								),

								array(
									'name'    => 'auto_testi',
									'label'   => 'Autoplay',
									'type'    => 'radio',  // USAGE RADIO TYPE
									'options' => array(    // REQUIRED
										'true'  => 'Yes',
										'false' => 'No',
									),

									'value'       => 'true', // remove this if you do not need a default content
									'description' => 'Check Yes If you want to autoplay Testimonial',
								),

							),


							'Typhography' => array(
								array(
									'name'        => 'name_font_size',
									'label'       => 'Name Font Size',
									'type'        => 'number_slider',
									'options'     => array(
										'min'        => 1,
										'max'        => 50,
										'unit'       => 'px',
										'show_input' => true,
									),
									'value'       => 18,
									'description' => 'use custom Client name fontsize, default is 18',
								),
								array(
									'name'        => 'descr_font_size',
									'label'       => 'Description Font Size',
									'type'        => 'number_slider',
									'options'     => array(
										'min'        => 1,
										'max'        => 50,
										'unit'       => 'px',
										'show_input' => true,
									),
									'value'       => 14,
									'description' => 'use custom Description fontsize, default is 14',
								),
								// Title  Color
								array(
									'name'        => 'c_name_col',
									'label'       => 'Client Name Color',
									'type'        => 'color_picker',
									'admin_label' => true,
									'value'       => '#000',
								),

								// Description  Color
								array(
									'name'        => 'c_descr_color',
									'label'       => 'Description Color',
									'type'        => 'color_picker',
									'admin_label' => true,

									'value' => '#444444',
								),

								//Description Background Color
								array(
									'name'        => 'c_label_color',
									'label'       => 'Label Color',
									'type'        => 'color_picker',
									'admin_label' => true,
									'value'       => '#aaa',
								),
							),

						),
					),
				) );
		}

		// Register Before After Shortcode
		function rdextkc_testimonial_func( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'descr_font_size' => '',
				'name_font_size'  => '',
				'c_descr_color'   => '',
				'c_label_color'   => '',
				'c_name_col'      => '',
				'client_image'    => '',
				'cl_name'         => 'Maxdew',
				'cl_label'        => 'google.com',
				'testi_descr'     => '',
				'test_margin'     => '',
				'test_width'      => '',
				'auto_testi'      => 'true',

			), $atts ) );
			$acoptions = $atts['acoptions'];
			$output    = '<div class="king-testimonial">';
			if ( isset( $acoptions ) ) {
				foreach ( $acoptions as $option ) {
					$option->client_image = wp_get_attachment_image_src( $option->client_image, 'thumbnail', 'full' );
					$output               .= '
<div class="slide">
            <div class="king-testimonials-carousel-thumbnail"><img alt="" src="' . $option->client_image[0] . '"></div>
                <div class="king-testimonials-carousel-context">
                <div style="font-color:' . $c_name_col . '; font-size:' . $name_font_size . ';" class="king-testimonials-name">' . $option->cl_name . ' <span style="color:' . $c_label_color . ';">' . $option->cl_label . '</span></div>
                <div class="king-testimonials-carousel-content"><p style="color:' . $c_descr_color . '; font-size:' . $descr_font_size . ';">' . $option->testi_descr . '</p></div>
            </div>
      </div>';
				}
			}

			$output .= '</div>';
			$output .= '<script type="text/javascript">
jQuery(".king-testimonial").bxSlider({
       slideWidth: ' . $test_width . ',
       minSlides: 1,
       maxSlides: 1,
       slideMargin: ' . $test_margin . ',
       auto: ' . $auto_testi . ',
       autoControls: true,
     });
</script>';

			return $output;
		}
	}

}
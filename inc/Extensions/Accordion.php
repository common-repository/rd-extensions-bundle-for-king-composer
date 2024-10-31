<?php
/**
 * @package  RdExtKc
 */
namespace Rdextkc\Extensions;

use Rdextkc\Base\ExtensionsController;

class Accordion extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'accordion' ) ) {
			return;
		}
		add_shortcode( 'rdextkc_accordion', array( $this, 'rdextkc_accordion_func' ) );
		add_action( 'init', array( $this, 'accordion' ) );
	}

	public function accordion() {
		global $kc;
		$kc->add_map( array(
				'rdextkc_accordion' => array(
					'name'        => 'Accordion',
					'description' => __( 'Flexible image before after shortcode', 'KingComposer' ),
					'icon'        => 'rdextkc_accordion_icon',
					'css_box'     => true,
					'category'    => 'RD Extensions',
					'params'      => array(

						'General'    => array(
							array(
								'type'        => 'group',
								'label'       => __( 'Add Accordion Items', 'KingComposer' ),
								'name'        => 'acoptions',
								'description' => __( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'KingComposer' ),
								'options'     => array( 'add_text' => __( 'Add new Items', 'kingcomposer' ) ),
								/*
									'value' => base64_encode( json_encode( array(
										"1" => array(
											"title" => "default value 1 of group 1",
											"acc_descr" => "default value 2 of group 1"
										),
									))),
								*/

								'params' => array(
									array(
										'name'  => 'title',
										'label' => 'Title',
										'type'  => 'text',
										'value' => 'Accordion 1',
									),

									array(
										'type'        => 'editor',
										'label'       => __( 'Modal Box Description', 'kingcomposer' ),
										'name'        => 'acc_descr',
										'description' => __( 'Description of the Modal Box.', 'kingcomposer' ),
										'value'       => base64_encode( 'Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo.Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis. Fusce dapibus, tellus ac cursus commodo' ),
										'admin_label' => true,
									),
									array(
										'name'  => 'act_accordion',
										'label' => 'Active Items',
										'type'  => 'toggle',
									),
								),
							),
						),


						// Title  Color
						'Typography' => array(

							array(
								'name'        => 'title_color',
								'label'       => 'Title Color',
								'type'        => 'color_picker',
								'admin_label' => true,
								'value'       => '#FFFFFF',
							),

							// Title Background Color
							array(
								'name'        => 'title_bg_color',
								'label'       => 'Title Background Color',
								'type'        => 'color_picker',
								'admin_label' => true,
								'value'       => '#27AE60',

							),

							// Description  Color
							array(
								'name'        => 'descr_color',
								'label'       => 'Description Color',
								'type'        => 'color_picker',
								'admin_label' => true,

								'value' => '#8c9195',
							),

							//Description Background Color
							array(
								'name'        => 'descr_bg_color',
								'label'       => 'Description Background Color',
								'type'        => 'color_picker',
								'admin_label' => true,
								'value'       => '#FAFAFA',
							),

							array(
								'name'        => 't_f_size',
								'label'       => 'Title Font Size',
								'type'        => 'number_slider',
								'options'     => array(
									'min'        => 1,
									'max'        => 30,
									'unit'       => 'px',
									'show_input' => true,
									'value'      => '18',
								),
								'description' => 'Title Font Size',
							),


							array(
								'name'        => 'd_f_size',
								'label'       => 'Description Font Size',
								'type'        => 'number_slider',
								'options'     => array(
									'min'        => 1,
									'max'        => 30,
									'unit'       => 'px',
									'show_input' => true,
									'value'      => '14',
								),
								'description' => 'Description Font Size',
							),
							array(
								'name'  => 'is_border',
								'label' => 'Border?',
								'type'  => 'toggle',
								'description' => 'Check This If Accordion Item Need Border, Otherwise Don\'t check this',
							),
							//Description Background Color
							array(
								'name'        => 'border_color',
								'label'       => 'Border Color',
								'type'        => 'color_picker',
								'admin_label' => true,
								'relation' => array(
									'parent'    => 'is_border',
									'show_when' => 'yes',
								),
							),
						),

					),
				),
			) );
	}

	// Register Before After Shortcode
	function rdextkc_accordion_func( $atts, $content = null ) {
		$code = '';
		extract( shortcode_atts( array(
			'title'          => '',
			'acc_descr'      => '',
			'acc_bg_color'   => '',
			't_f_size'       => '18',
			'd_f_size'       => '14',
			'title_bg_color' => '',
			'title_color'    => '',
			'descr_bg_color' => '',
			'descr_color'    => '',
			'act_accordion'  => '',
			'border_color'  => '',
		), $atts ) );

		$active_item = "";
		$acoptions   = $atts['acoptions'];
		$output = '<div class="accordion-wrapper">';
		if ( isset( $acoptions ) ) {
			foreach ( $acoptions as $option ) {
				$active_item = $option->act_accordion == 'yes' ? 'active' : '';
				$output      .= '<div class="ac-pane ' . $active_item . '">
                <a style="background-color:' . $title_bg_color . '; text-decoration:none; " href="#" class="ac-title" data-accordion="true">
                    <span style="font-size:' . $t_f_size . '; color:' . $title_color . ';">' . $option->title . '</span>
                    <i class="fa"></i>
                </a>
                <div style="background:' . $descr_bg_color . '; border: 2px solid '.$border_color.'; border-top: none;" class="ac-content">
                   <p style="font-size:' . $d_f_size . '; color:' . $descr_color . ';"> ' . $option->acc_descr . ' </p>
                </div>
            </div>';
			}
		}
		$output .= '</div>';

		return $output;
	}
}
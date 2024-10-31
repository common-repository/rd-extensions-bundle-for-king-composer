<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Extensions;

use Rdextkc\Base\ExtensionsController;

class PricingTable extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'pricing_table' ) ) {
			return;
		}
		add_shortcode( 'rdextkc_pricingtable', array( $this, 'rdextkc_pricingtable_func' ) );

		add_action( 'init', array( $this, 'pricing_table' ) );
	}

	public function pricing_table() {
		global $kc;
		$kc->add_map( array(
			'rdextkc_pricingtable' => array(
				'name'        => 'Pricing Table',
				'description' => __( 'flexible image before after shortcode', 'rdextkc' ),
				'icon'        => 'rdextkc_pricingtable_icon',
				'css_box'     => true,
				'category'    => 'RD Extensions',
				'params'      => array(
					// General Group Start
					'Add Items'  => array(
						array(
							'type'        => 'group',
							'label'       => __( 'Add pricingtable Items', 'rdextkc' ),
							'name'        => 'acoptions',
							'description' => __( 'Repeat this fields with each item created, Each item corresponding processbar element.', 'rdextkc' ),
							'options'     => array( 'add_text' => __( 'Add new items', 'rdextkc' ) ),
							/*        // default values when create new group
									'value' => base64_encode( json_encode( array(
										"1" => array(
											"title" => "default value 1 of group 1",
											"acc_descr" => "default value 2 of group 1"
										),
									))),*/
							'params'      => array(
								array(
									'name'  => 'pric_feature',
									'label' => 'Pricing Feature',
									'type'  => 'text',
									'value' => __( 'Add Pricing Feature Here', 'rdextkc' ),
								),

							),
						),
					),
					// General Group End
					'Options'    => array(
						array(
							'name'  => 'king_planname',
							'label' => 'Plan Name',
							'type'  => 'text',
							'value' => __( 'Add You Plan Name', 'rdextkc' ),
						),
						array(
							'name'  => 'king_plan_duration',
							'label' => 'Plan Duration',
							'type'  => 'text',
							'value' => __( '$10 / month', 'rdextkc' ),
						),

						array(
							'name'  => 'king_buttonname',
							'label' => 'Button Name',
							'type'  => 'text',
							'value' => __( 'BUY NOW!', 'rdextkc' ),
						),

						array(
							'name'  => 'king_buttonurl',
							'label' => 'Button URL',
							'type'  => 'text',
							'value' => __( 'http://example.com', 'rdextkc' ),
						),
					),
					'Typography' => array(

						// Description  Color
						array(
							'name'        => 'head_planbg_color',
							'label'       => 'plan Background Color',
							'type'        => 'color_picker',
							'admin_label' => true,
							'value'       => '#CE4D4F',
						),
						// Description  Color
						array(
							'name'        => 'text_durationbg_color',
							'label'       => 'Duration Area Background Color',
							'type'        => 'color_picker',
							'admin_label' => true,
							'value'       => '#EF5A5C',
						),

						// Description  Color
						array(
							'name'        => 'king_button_color',
							'label'       => 'Button Background Color',
							'type'        => 'color_picker',
							'admin_label' => true,
							'value'       => '#C9302C',
						),
						// Description  Color
						array(
							'name'        => 'king_border_color',
							'label'       => 'Border Color',
							'type'        => 'color_picker',
							'admin_label' => true,
							'value'       => '#C9302C',
						),
						array(
							'name'        => 'hea_plansize',
							'label'       => 'Head Font Size',
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 5,
								'max'        => 30,
								'unit'       => 'px',
								'show_input' => true,
							),
							'value'       => 16,
							'description' => 'Use Custom plan Size, default is 16px',
						),

						array(
							'name'        => 'hea_durationsize',
							'label'       => 'Duration Font Size',
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 5,
								'max'        => 60,
								'unit'       => 'px',
								'show_input' => true,
							),
							'value'       => 30,
							'description' => 'Use Custom plan Size, default is 30px',
						),
					),
				),
			),
		) );
	}


	// Register Before After Shortcode
	function rdextkc_pricingtable_func( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'pric_feature'          => '',
			'king_planname'         => '',
			'king_plan_duration'    => '',
			'king_buttonname'       => '',
			'king_button_color'     => '',
			'head_planbg_color'     => '',
			'text_durationbg_color' => '',
			'king_border_color'     => '',
			'hea_plansize'          => '',
			'hea_durationsize'      => '',
			'king_buttonurl'        => '',
		), $atts ) );

		$acoptions = $atts['acoptions'];
		$output    = '<div class="king-pricing-items">
            <div class="panel price panel-red">
                <div style="background-color:' . $head_planbg_color . '; border-color: ' . $king_border_color . ';" class="panel-heading  text-center">
                    <h3 style="font-size:' . $hea_plansize . '; color:#ffffff;">' . strtoupper( $king_planname ) . '</h3>
                </div>

                <div style="background-color:' . $text_durationbg_color . '"; class="panel-body text-center">
                    <p class="lead" style="font-size:' . $hea_durationsize . '; color:#ffffff;"><strong>' . $king_plan_duration . '</strong></p>
                </div>

                <ul class="list-group list-group-flush text-center">';
		if ( isset( $acoptions ) ) {
			foreach ( $acoptions as $option ) {
				$output .= '<li class="list-group-item" id="fea_pricing"><i class="icon-ok text-danger"></i>' . $option->pric_feature . '</li>';
			}
		}
		$output .= ' </ul>
                <div class="panel-footer">
                    <a style="background:' . $king_button_color . '; color:#ffffff;" class="btn btn-lg btn-block btn-danger" href="' . $king_buttonurl . '">' . $king_buttonname . '</a>
                </div>
            </div>
        </div>';

		return $output;
	}
}
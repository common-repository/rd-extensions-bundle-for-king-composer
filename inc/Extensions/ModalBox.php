<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Extensions;


use Rdextkc\Base\ExtensionsController;

class ModalBox extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'modalbox' ) ) {
			return;
		}
		add_shortcode( 'rdextkc_modalbox', array( $this, 'rdextkc_modalbox_func' ) );
		add_action( 'init', array( $this, 'modalbox' ) );
	}

	public function modalbox() {
		global $kc;
		$kc->add_map( array(
			'rdextkc_modalbox' => array(
				'name'        => 'modal Box',
				'description' => __( 'Modal Box', 'rdextkc' ),
				'icon'        => 'rdextkc_modalbox_icon',
				//'is_container' => true,
				'category'    => 'RD Extensions',
				'css_box'     => true,
				'params'      => array(

					// GENERAL SETTING SECTION
					'General' => array(
						array(
							'type'        => 'text',
							'label'       => __( 'Button Name', 'rdextkc' ),
							'name'        => 'b_text',
							'description' => __( 'This is Button name of Modal.', 'rdextkc' ),
							'admin_label' => true,
						),
						array(
							'type'        => 'text',
							'label'       => __( 'Modal Box Title', 'rdextkc' ),
							'name'        => 'mod_title',
							'description' => __( 'write Title For Modal Box.', 'rdextkc' ),
							'admin_label' => true,
						),

						array(
							'type'        => 'textarea',
							'label'       => __( 'Modal Box Description', 'rdextkc' ),
							'name'        => 'mod_descr',
							'description' => __( 'Description of the Modal Box.', 'rdextkc' ),
							'admin_label' => true,
						),
					),

					'Settings'   => array(
						array(
							'name'  => 'modal_animation',
							'label' => 'Animation',

							'type'        => 'select',  // USAGE SELECT TYPE
							'options'     => array(  // THIS FIELD REQUIRED THE PARAM OPTIONS
								'flip'        => 'Flip',
								'slide-left'  => 'Left',
								'slide-right' => 'Right',
								'scale'       => 'Scale',
								'fade'        => 'Fade',
							),
							'value'       => 'flip', // remove this if you do not need a default content
							'description' => 'Select Modal Box Animation here, Default animation is Flip ',
						),
					),


					// TYPOGRAPHY SETTING SECTION
					'Typography' => array(
						array(
							'name'        => 'b_bg_color',
							'label'       => 'Button Background Color',
							'type'        => 'color_picker',
							'admin_label' => true,
							'description' => 'Chose background color For Button',
						),
						array(
							'name'        => 'button_f_color',
							'label'       => 'Button Font Color',
							'type'        => 'color_picker',
							'admin_label' => true,
						),

						array(
							'type'        => 'color_picker',
							'label'       => 'Box Background Color',
							'name'        => 'box_bg_color',
							'admin_label' => true,
						),


						array(
							'type'        => 'color_picker',
							'label'       => 'Box Title Color',
							'name'        => 'box_tl_color',
							'admin_label' => true,
						),


						array(
							'type'        => 'color_picker',
							'label'       => 'Box Description Color',
							'name'        => 'box_dsc_color',
							'admin_label' => true,
						),
						array(
							'name'        => 'b_f_size',
							'label'       => 'Button font size',
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 0,
								'max'        => 40,
								'unit'       => 'px',
								'show_input' => true,
							),
							'value'       => '14',
							'description' => 'Chose Button Font Size here, Default is 14px',
						),

						array(
							'name'        => 'box_tit_size',
							'label'       => 'Box font size',
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 0,
								'max'        => 40,
								'unit'       => 'px',
								'show_input' => true,
							),
							'value'       => '18',
							'description' => 'Modal Popup Box Title Size',
						),


						array(
							'name'        => 'box_descr_size',
							'label'       => 'Box Description size',
							'type'        => 'number_slider',
							'options'     => array(
								'min'        => 0,
								'max'        => 40,
								'unit'       => 'px',
								'show_input' => true,
							),
							'value'       => '14',
							'description' => 'Modal Popup Box Description Size',
						),


					),
				),
			),
		) );
	}


	// Register Hover Shortcode
	function rdextkc_modalbox_func( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'b_text'          => 'Open Modal Click Here',
			'b_f_size'        => '',
			'button_f_color'  => '',
			'b_bg_color'      => '',
			'mod_title'       => '',
			'mod_descr'       => '',
			'box_bg_color'    => '',
			'box_tl_color'    => '',
			'box_dsc_color'   => '',
			'modal_animation' => '',
			'box_tit_size'    => '',
			'box_descr_size'  => '',
		), $atts ) );
		$modid  = rand( 1, 100000 );
		$output = '<div class="dt-modal-button ' . $css . '">
                         <a style="font-size:' . $b_f_size . '; background:' . $b_bg_color . '; color:' . $button_f_color . ';" href="#dt-modal' . $modid . '" class="dt-button dt-button-large dt-button-blue">' . $b_text . '</a>
                 </div>';
		$output .= '
        <div class="dt-modal-box-container">	
            <a href="#" class="dt-overlay" id="dt-modal' . $modid . '"></a>
            <div class="dt-modal-box dt-' . $modal_animation . '">
                <div style="background:' . $box_bg_color . ';" class="dt-modal-box-header">
                    <h4 style="color:' . $box_tl_color . '; font-size:' . $box_tit_size . ';">' . $mod_title . '</h4>
                </div>
                <div style="background:' . $box_bg_color . ';" class="dt-modal-box-section">
                    <p style="color:' . $box_dsc_color . '; font-size:' . $box_descr_size . ';">' . $mod_descr . '</p>
                </div>	
                <div style="background:' . $box_bg_color . ';" class="dt-modal-box-footer">						
                    <a href="#dt-close" class="dt-close-button">Close</a>
                </div>     
            </div>
        </div>
        ';

		return $output;
	}
}
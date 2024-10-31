<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Extensions;

use Rdextkc\Base\ExtensionsController;

class IconAnimation extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'icon_animation' ) ) {
			return;
		}
		add_shortcode( 'rdextkc_iconanimation', array( $this, 'rdextkc_iconanimation_shortcode_function' ) );
		add_action( 'init', array( $this, 'iconAnimation' ) );
		//$this->iconAnimation();
	}

	public function iconAnimation() {
		global $kc;
		$kc->add_map( array(
				'rdextkc_iconanimation' => array(
					"name"         => __( "Icon Animation", 'rdext_vc' ),
					"icon"         => "rdextkc_icon_animation",
					"category"     => 'RD Extensions',
					'description'  => 'Icon animation with Text',
					'is_container' => true,
					"params"       => array(

						'General' => array(
							array(
								'type'        => 'icon_picker',
								'heading'     => __( 'Icon', 'rdext_vc' ),
								'name'        => 'icon_fontawesome',
								'admin_label' => true,
								'description' => __( 'Chose Icon For List', 'rdext_vc' ),
							),
							array(
								"type"        => "textarea_html",
								"label"       => __( "Content Here", "rdext_vc" ),
								"name"        => "content",
								"admin_label" => true,
								"value"       => __( "<span style='font-weight:bold;font-size:17px'>Here is the title</span><br />And here is some other text information, you can put <a href='https://codecans.com/plugins'>a link</a> too.", "rdext_vc" ),
								"description" => __( "Content Goes Here", "rdext_vc" ),
							),
							array(
								"type"        => "text",
								"label"     => __( "Extra class name for the icon", "rdext_vc" ),
								"name"  => "icon_class",
								"description" => __( "You can append extra class to the icon, for example <strong>fa-rotate-90</strong> will rotate the icon 90 degree in some animation. <a href='http://fortawesome.github.io/Font-Awesome/examples/' target='_blank'>for more information</a>", "rdext_vc" ),
							),
							array(
								"type"        => "text",
								"label"     => __( "Extra class name for the text", "rdext_vc" ),
								"name"  => "el_class",
								"description" => __( "If you wish to style the text differently, then use this field to add a class name and then refer to it in your css file.", "rdext_vc" ),

							),
						),

						'Settings' => array(
							array(
								"type"        => "select",
								"heading"     => __( "Icon animation", "rdext_vc" ),
								"name"        => "animation",
								"description" => __( 'Select the icon animation.', 'rdext_vc' ),
								"options"     => array(
									__( "wrench", "rdext_vc" )       => 'wrench',
									__( "ring", "rdext_vc" )         => 'ring',
									__( "vertical", "rdext_vc" )     => 'vertical',
									__( "horizontal", "rdext_vc" )   => 'horizontal',
									__( "flash", "rdext_vc" )        => 'flash',
									__( "bounce", "rdext_vc" )       => 'bounce',
									__( "spin fast", "rdext_vc" )    => 'spin',
									__( "spin slow", "rdext_vc" )    => 'spinslow',
									__( "float", "rdext_vc" )        => 'float',
									__( "pulse", "rdext_vc" )        => 'pulse',
									__( "shake", "rdext_vc" )        => 'shake',
									__( "swing", "rdext_vc" )        => 'swing',
									__( "tada", "rdext_vc" )         => 'tada',
									__( "rubberBand", "rdext_vc" )   => 'rubberBand',
									__( "wobble", "rdext_vc" )       => 'wobble',
									__( "flip", "rdext_vc" )         => 'flip',
									__( "no animation", "rdext_vc" ) => '',
								),
							),
							array(
								'name'        => 'size',
								'label'       => __( "Icon size", "rdext_vc" ),
								'type'        => 'number_slider',
								'tooltip'     => __( 'Choose Member Name Font Size Here. For large numbers it\'s better use 18px Font Size.', 'team_vc' ),
								'options'     => array(
									'min'        => 0,
									'max'        => 200,
									'unit'       => 'px',
									'show_input' => true,
								),
								'value'       => 2,
								'description' => __( "Select the icon size. Default is 14em", "rdext_vc" ),
							),
							array(
								"type"        => "color_picker",
								"label"     => __( "Icon color", "rdext_vc" ),
								"name"  => "ico_color",
								"value"       => "#00BFFF",
								"description" => __( "Select color for the icon", "rdext_vc" ),
							),
							array(
								"type"        => "select",
								"label"     => __( "Icon float:", "rdext_vc" ),
								"name"  => "float",
								"description" => __( '', 'rdext_vc' ),
								"options"       => array(
									__( "left", "rdext_vc" )  => 'pull-left',
									__( "right", "rdext_vc" ) => 'pull-right',
								),
							),


						),


						/*
											array(
												"type"             => "prime_param_heading",
												"text"             => "<span class='phyoutubeparam'>
													<iframe allowFullScreen='allowFullScreen' width='700px' height='340px'
													src='https://www.youtube.com/embed/aegL2LZ-xys' frameborder='0' allowfullscreen>
													</iframe>
												</span>",
												"param_name"       => "notification",
												'edit_field_class' => 'prime-param-important-wrapper prime-dashicon prime-align-right prime-bold-font prime-blue-font vc_column vc_col-sm-12',
												"group"            => "Video Tutorial",
											),*/

					),
				),
			)

		);
	}

	function rdextkc_iconanimation_shortcode_function( $atts, $content = null, $tag ) {
		extract( shortcode_atts( array(
			'float'            => 'left',
			'ico_color'        => '#00BFFF',
			'size'             => '2',
			'icon_fontawesome' => 'fa fa-angellist',
			'el_class'         => '',
			'icon_class'       => '',
			'animation'        => 'wrench',
			'isanimate'        => 'on',
		), $atts ) );
		//$content = wpb_js_remove_wpautop( $content );

		$size = $atts['size'] != '' ? (int) esc_attr( $atts['size'] ) : 3;
		if ( $el_class != "" ) {
			$output = '<i style="color:' . $ico_color . '; font-size:' . $size . 'em;" id="icon_anime" class="anime ' . esc_attr( $icon_fontawesome ) . ' faa-' . $animation . ' ' . $icon_class . '"></i><div class="' . $el_class . '">' . $content . '</div>';
		} else {
			$output = '<i style="color:' . $ico_color . '; font-size:' . $size . 'em;" id="icon_anime" class="anime ' . esc_attr( $icon_fontawesome ) . ' faa-' . $animation . ' ' . $icon_class . '"></i>' . $content . '';
		}

		return $output;
	}
}
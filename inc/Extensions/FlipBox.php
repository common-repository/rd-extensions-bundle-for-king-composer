<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Extensions;

use Rdextkc\Base\ExtensionsController;

class FlipBox extends ExtensionsController {
	public function extensions_register() {
		if ( ! $this->activated( 'flipbox' ) ) {
			return;
		}
		add_shortcode( 'rdextkc_flipbox', array( $this, 'rdextkc_flipbox_shortcode_func' ) );
		add_action( 'init', array( $this, 'flipbox' ) );
		//$this->iconAnimation();
	}

	public function flipbox() {
		global $kc;
		$kc->add_map( array(
				'rdextkc_flipbox' => array(
					'name' => 'FlipBox',
					'description' => __('modern flip box shortcode', 'rdext_vc'),
					'icon' => 'rdextkc_flipbox_icon',
					'css_box' => true,
					'category' => 'RD Extensions',
					'params' => array(

						'general' => array(
							array(
								"type" => "select",
								"label" => __("Direction", "rdext_vc"),
								"name" => "direction",
								'options' => array(
									'flip-vertical' => 'Verticle',
									'' => 'Horizontal',
								),
								'description' => 'Choose animation direction',
							),
							array(
								'type' => 'text',
								'label' => __('Extra class name', 'rdext_vc'),
								'name' => 'extraclass',
								'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'rdext_vc')
							),

						),

						'Front' => array(
							array(
								'name' => 'front_box_color',
								'label' => 'Box color',
								'type' => 'color_picker',
								"description" => __("Choose flipbox color.", "rdext_vc"),
							),
							array(
								"type" => "select",
								"name" => "show_icon",
								"label" => __("Show Icon", "rdext_vc"),
								'options' => array(
									'yes' => 'Yes',
									'no' => 'No',
								),
								'value' => 'no',
							),
							array(
								'name' => 'icon_fontawesome',
								'label' => 'Icon',
								'type' => 'icon_picker',
								"description" => __("Select icon from library.", "rdext_vc"),
								'relation' => array(
									'parent' => 'show_icon',
									'show_when' => 'yes',
								),
							),
							array(
								'name' => 'icon_size',
								'label' => 'Icon Size',
								'type' => 'number_slider',
								'options' => array(
									'min' => 16,
									'max' => 100,
									'unit' => 'px',
									'show_input' => true
								),
								'value' => 20,
								'description' => 'Provide icon size',
								'relation' => array(
									'parent' => 'show_icon',
									'show_when' => 'yes',
								),
							),
							array(
								'name' => 'icon_color',
								'label' => 'Icon Color',
								'type' => 'color_picker',
								'value' => '#343434',
								"description" => __("Choose icon color.", "rdext_vc"),
								'relation' => array(
									'parent' => 'show_icon',
									'show_when' => 'yes',
								),
							),
							array(
								'name' => 'title',
								'label' => 'Title',
								'type' => 'text',
							),
							array(
								'name' => 'front_desc',
								'label' => 'Description',
								'type' => 'textarea',
							),
							array(
								'name' => 'title_f_size',
								'label' => 'Title Font Size',
								'type' => 'number_slider',
								'options' => array(
									'min' => 10,
									'max' => 50,
									'unit' => 'px',
									'show_input' => true
								),
								'value' => 18,
								'description' => 'Chose Title Font Size as Pixel. Default is 18px',
							),

							array(
								'name' => 'title_color',
								'label' => 'Title Color',
								'type' => 'color_picker',
								"description" => __("Choose text color", "rdext_vc"),
							),
							array(
								'name' => 'desc_f_size',
								'label' => 'Description Font Size',
								'type' => 'number_slider',
								'options' => array(
									'min' => 10,
									'max' => 50,
									'unit' => 'px',
									'show_input' => true
								),
								'value' => 14,
								'description' => 'Chose Title Font Size as Pixel. Default is 14px',
							),

							array(
								'name' => 'descr_color',
								'label' => 'Description Color',
								'type' => 'color_picker',
								"description" => __("Choose text color", "rdext_vc"),
							),

						),

						'Back' => array(
							array(
								'name' => 'back_box_color',
								'label' => 'Box color',
								'type' => 'color_picker',
								"description" => __("Choose flipbox color.", "rdext_vc"),
							),
							array(
								"type" => "select",
								"name" => "back_show_icon",
								"label" => __("Show Icon", "rdext_vc"),
								'options' => array(
									'yes' => 'Yes',
									'no' => 'No',
								),
								'value' => 'no',
							),
							array(
								'name' => 'back_icon_fontawesome',
								'label' => 'Icon',
								'type' => 'icon_picker',
								"description" => __("Select icon from library.", "rdext_vc"),
								'relation' => array(
									'parent' => 'back_show_icon',
									'show_when' => 'yes',
								),
							),
							array(
								'name' => 'back_icon_size',
								'label' => 'Icon Size',
								'type' => 'number_slider',
								'options' => array(
									'min' => 16,
									'max' => 100,
									'unit' => 'px',
									'show_input' => true
								),
								'value' => 20,
								'description' => 'Provide icon size',
								'relation' => array(
									'parent' => 'back_show_icon',
									'show_when' => 'yes',
								),
							),
							array(
								'name' => 'back_icon_color',
								'label' => 'Icon Color',
								'type' => 'color_picker',
								'value' => '#343434',
								"description" => __("Choose icon color.", "rdext_vc"),
								'relation' => array(
									'parent' => 'back_show_icon',
									'show_when' => 'yes',
								),
							),
							array(
								'name' => 'back_title',
								'label' => 'Title',
								'type' => 'text',
							),
							array(
								'name' => 'back_desc',
								'label' => 'Description',
								'type' => 'textarea',
							),
							array(
								'name' => 'back_title_f_size',
								'label' => 'Title Font Size',
								'type' => 'number_slider',
								'options' => array(
									'min' => 10,
									'max' => 50,
									'unit' => 'px',
									'show_input' => true
								),
								'value' => 18,
								'description' => 'Chose Title Font Size as Pixel. Default is 18px',
							),

							array(
								'name' => 'back_title_color',
								'label' => 'Title Color',
								'type' => 'color_picker',
								"description" => __("Choose text color", "rdext_vc"),
							),
							array(
								'name' => 'back_desc_f_size',
								'label' => 'Description Font Size',
								'type' => 'number_slider',
								'options' => array(
									'min' => 10,
									'max' => 50,
									'unit' => 'px',
									'show_input' => true
								),
								'value' => 14,
								'description' => 'Chose Title Font Size as Pixel. Default is 14px',
							),

							array(
								'name' => 'back_descr_color',
								'label' => 'Description Color',
								'type' => 'color_picker',
								"description" => __("Choose text color", "rdext_vc"),
							),
							array(
								"type" => "select",
								"name" => "show_button",
								"label" => __("Show Button", "rdext_vc"),
								'options' => array(
									'yes' => 'Yes',
									'no' => 'No',
								),
								'value' => 'no',
							),
							array(
								'name' => 'btn_text',
								'label' => 'Text on Button',
								'type' => 'text',
								"value" => "Read More",
								'relation' => array(
									'parent' => 'show_button',
									'show_when' => 'yes',
								),
							),


						),
						'Link' => array(
							array(
								'name' => 'on_click',
								'label' => 'On Click',
								'type' => 'select',
								'options' => array(
									'none' => 'No Link',
									'box' => 'Complete Box',
								),
							),
							array(
								"type" => "link",
								"label" => __("Add Link", "rdext_vc"),
								"name" => "link",
								"description" => __("Add a custom link or select existing page. You can remove existing link as well.", "rdext_vc"),
								'relation' => array(
									'parent' => 'on_click',
									'show_when' => 'box',
								),
							),

						),


					)
				)
			)

		);
	}

	function rdextkc_flipbox_shortcode_func( $atts, $content = null, $tag ) {
		extract( shortcode_atts( array(
			'direction'      => 'flip-vertical',
			'show_icon'      => '',
			'icon_fontawesome'   => '',
			'front_box_color'   => '#f7f7f7',
			'back_box_color'     => '#9bcc18',
			'icon_size'            => '40',
			'icon_color'      => '#42bce2',
			'title'         => '',
			'front_desc'      => '',
			'title_f_size'      => '',
			'desc_f_size'      => '',
			'title_color'      => '',
			'descr_color'      => '',
			'back_show_icon'  => '',
			'back_icon_fontawesome'  => '',
			'back_title'      => '',
			'back_desc'      => '',
			'back_title_f_size'  => '',
			'back_icon_size'  => '40',
			'back_icon_color'  => '',
			'back_desc_f_size'  => '',
			'back_title_color'   => '',
			'back_descr_color'   => '',
			'show_button'      => '',
			'btn_text'      => 'Read More',
			'link'      => '',
			'css_flip_box'      => '',
			'extraclass' => '',

		), $atts ) );


		$link   = kc_parse_link( $link );
		$output ='';
		$front_data ='';
		$back_data ='';


		if( $show_icon == 'yes' && !empty( $icon_fontawesome ) )
			$front_data .= '<div class="wrap-icon"><i style="font-size:'.$icon_size.'px; color:'.$icon_color.';" class="'.$icon_fontawesome.'"></i></div>';

		if( !empty( $title ) )
			$front_data .= '<h3 style="font-size:'.$title_f_size.'px; color:'.$title_color.'; ">'. $title .'</h3>';

		if(!empty($front_desc))
			$front_data .= '<p style="font-size:'.$desc_f_size.'px; color:'.$descr_color.'; ">'. $front_desc .'</p>';

		//back side
		if( $back_show_icon == 'yes' && !empty( $back_icon_fontawesome ) )
			$back_data .= '<div class="wrap-icon"><i style="font-size:'.$back_icon_size.'px; color:'.$back_icon_color.';" class="'.$back_icon_fontawesome.'"></i></div>';

		if( !empty( $back_title ) )
			$back_data .= '<h3 style="font-size:'.$back_title_f_size.'px; color:'.$back_title_color.';">'. $back_title .'</h3>';

		if(!empty($back_desc))
			$back_data .= '<p style="font-size:'.$back_desc_f_size.'px; color:'.$back_descr_color.'; ">'. $back_desc .'</p>';



		if( $show_button == 'yes' ){

			$back_data .= '<a style="background-color:'.$icon_color.'; margin-top: -10px;" class="button" href="'.$link['url'].'" title="'.$link['title'].'" target="'.$link['target'].'">'. $btn_text .'</a>';

		}

		$output .='<div class="rdext-flipbox rdext-flip-container '.$direction.' '.$extraclass.'">
                            <div class="flipper">
                            <div class="front" style="background:'.$front_box_color.';">
                            <div class="front-content">';

		$output .= $front_data;

		$output .= '</div>
                             </div>';


		$output .='<div class="back" style="background:'.$back_box_color.';">
                            <div class="des">';

		$output .= $back_data;

		$output .= '</div>
                            </div>';

		$output .= '</div>
                            </div>';
		return $output;
	}
}
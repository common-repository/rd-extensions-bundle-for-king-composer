<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Base;

class ExtensionsController {
	public function activated( $key ) {
		$option = get_option( 'rdextkc_kingcomposer' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}
}
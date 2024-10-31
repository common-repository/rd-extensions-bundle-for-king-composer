<?php
/**
 * @package  AlecadddPlugin
 */
namespace Rdextkc;

final class Extensions {
	/**
	 * Store all the classes inside an array
	 *
	 * @return array Full list of classes
	 */
	public static function get_services() {
		return [

			Extensions\IconAnimation::class,
			Extensions\BeforeAfter::class,
			Extensions\FlipBox::class,
			Extensions\Separator::class,
			Extensions\Accordion::class,
			Extensions\AnimateBox::class,
			Extensions\HoverEffects::class,
			Extensions\InfoBox::class,
			Extensions\ModalBox::class,
			Extensions\PricingTable::class,
			Extensions\Testimonial::class,
			Extensions\ServiceBox::class,
			Extensions\ProgressBar::class,
		];

	}

	/**
	 * Loop through the classes::class, initialize them::class,
	 * and call the register() method if it exists
	 *
	 * @return
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$extensions = self::instantiate( $class );
			if ( method_exists( $extensions, 'extensions_register' ) ) {
				$extensions->extensions_register();
			}
		}
	}

	/**
	 * Initialize the class
	 *
	 * @param  class $class class from the services array
	 *
	 * @return class instance  new instance of the class
	 */
	private static function instantiate( $class ) {
		$extensions = new $class();

		return $extensions;
	}

}
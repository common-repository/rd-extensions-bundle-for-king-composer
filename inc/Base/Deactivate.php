<?php
/**
 * @package  PrimeExtVc
 */
namespace Rdextkc\Base;

class Deactivate {
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
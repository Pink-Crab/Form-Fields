<?php

declare(strict_types=1);

/**
 * Trait containing tests for all Placeholder functionality
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Trait_Test_Cases;

trait Trait_Placeholder_Tests {

	/**
	 * Test can set and get the placeholder
	 *
	 * @return void
	 */
	public function test_placeholder(): void {
		self::$field->placeholder( 'placeholder' );
		$this->assertArrayHasKey( 'placeholder', self::$field->get_attributes() );
		$this->assertEquals( 'placeholder', self::$field->get_attributes()['placeholder'] );
		$this->assertNotEquals( 'NOTplaceholder', self::$field->get_attributes()['placeholder'] );
	}
}

<?php

declare(strict_types=1);

/**
 * Trait containing tests for all Autocomplete functionality
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Trait_Test_Cases;

trait Trait_Range_Tests {


	/**
	 * Test the min settings
	 *
	 * @return void
	 */
	public function test_min_attribute(): void {

		// Set
		self::$field->min( 0 );

		// Get
		$this->assertEquals( 0, self::$field->get_min() );

		// In Attributes (run render first)
		self::$field->as_string();
		$this->assertArrayHasKey( 'min', self::$field->get_attributes() );
		$this->assertEquals( 0, self::$field->get_attributes()['min'] );
		$this->assertNotEquals( '42', self::$field->get_attributes()['min'] );

	}

	/**
	 * Test the max settings
	 *
	 * @return void
	 */
	public function test_max_attribute(): void {

		// Set
		self::$field->max( 99 );

		// Get
		$this->assertEquals( 99, self::$field->get_max() );

		// In Attributes (run render first)
		self::$field->as_string();
		$this->assertArrayHasKey( 'max', self::$field->get_attributes() );
		$this->assertEquals( 99, self::$field->get_attributes()['max'] );
		$this->assertNotEquals( '42', self::$field->get_attributes()['max'] );

	}

	/**
	 * Test the step settings
	 *
	 * @return void
	 */
	public function test_step_attribute(): void {

			// Set
		self::$field->step( 5 );

		// Get
		$this->assertEquals( 5, self::$field->get_step() );

		// In Attributes (run render first)
		self::$field->as_string();
		$this->assertArrayHasKey( 'step', self::$field->get_attributes() );
		$this->assertEquals( 5, self::$field->get_attributes()['step'] );
		$this->assertNotEquals( '42', self::$field->get_attributes()['step'] );

	}
}

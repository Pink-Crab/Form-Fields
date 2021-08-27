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

use Gin0115\WPUnit_Helpers\Objects;


trait Trait_Length_Tests {


	/**
	 * Test the minlength settings
	 *
	 * @return void
	 */
	public function test_minlength_attribute(): void {

		// Set
		self::$field->minlength( 5 );

		// Test added to property
		$this->assertEquals( 5, Objects::get_property( self::$field, 'minlength' ) );

		// Get
		$this->assertEquals( 5, self::$field->get_minlength() );

		// In Attributes (run render first)
		self::$field->as_string();
		$this->assertArrayHasKey( 'minlength', self::$field->get_attributes() );
		$this->assertEquals( 5, self::$field->get_attributes()['minlength'] );
		$this->assertNotEquals( '42', self::$field->get_attributes()['minlength'] );

	}

	/**
	 * Test the maxlength settings
	 *
	 * @return void
	 */
	public function test_maxlength_attribute(): void {

		// Set
		self::$field->maxlength( 99 );

		// Test added to property
		$this->assertEquals( 99, Objects::get_property( self::$field, 'maxlength' ) );

		// Get
		$this->assertEquals( 99, self::$field->get_maxlength() );

		// In Attributes (run render first)
		self::$field->as_string();
		$this->assertArrayHasKey( 'maxlength', self::$field->get_attributes() );
		$this->assertEquals( 99, self::$field->get_attributes()['maxlength'] );
		$this->assertNotEquals( '42', self::$field->get_attributes()['maxlength'] );

	}

}

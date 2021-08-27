<?php

declare(strict_types=1);

/**
 * Checkbox group tests
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use WP_UnitTestCase;
use Gin0115\WPUnit_Helpers\Objects;
use Symfony\Component\DomCrawler\Crawler;
use PinkCrab\Form_Fields\Fields\Checkbox_Group;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Checkbox_Group extends WP_UnitTestCase {

	/**
	 * Holds the input type
	 *
	 * @var string
	 */
	protected $field_type = Checkbox_Group::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Checkbox_Group
	 */
	protected static $field;

	use Trait_General_Field_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Checkbox_Group::create( 'key' );
	}

	/** @testdox It should be possible to set the value each checkbox is given as its value */
	public function test_can_set_get_checked_value() {
		self::$field->checked_value( 'foo' );
		$this->assertEquals(
			'foo',
			Objects::get_property( self::$field, 'checked_value' )
		);
	}

	/** @testdox All current values should be set as an array, regardless of the format used. */
	// OVER WRITES THE METHOD FORM TRAIT.
	public function test_current_value(): void {

		// Sets a string, should be array with 1 value.
		self::$field->current( 'string' );
		$this->assertIsArray( Objects::get_property( self::$field, 'current' ) );
		$this->assertContains( 'string', Objects::get_property( self::$field, 'current' ) );

		// Sets an array as the current, not as part of the array.
		self::$field->current( array( 'array' ) );
		$this->assertIsArray( Objects::get_property( self::$field, 'current' ) );
		$this->assertContains( 'array', Objects::get_property( self::$field, 'current' ) );

		// Empty values should be an empty array.
		self::$field->current( '' );
		$this->assertIsArray( Objects::get_property( self::$field, 'current' ) );
		$this->assertEmpty( Objects::get_property( self::$field, 'current' ) );
	}

	/** @testdox It should be possible to set  */
	public function test_can_set_options(): void {
		self::$field->options(
			array(
				'a' => 'Apple',
				'b' => 'Banana',
			)
		);

		$this->assertArrayHasKey( 'a', self::$field->get_options() );
		$this->assertArrayHasKey( 'b', self::$field->get_options() );
		$this->assertEquals( 'Apple', self::$field->get_options()['a'] );
		$this->assertEquals( 'Banana', self::$field->get_options()['b'] );
	}




}

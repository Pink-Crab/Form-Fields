<?php

declare(strict_types=1);

/**
 * Input with type TEXT tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use WP_UnitTestCase;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Fields\Input_Number;
use PinkCrab\Form_Fields\Tests\Fields\Trait_General_Field_Tests;

class Test_Input_Number extends WP_UnitTestCase {


	/**
	 * Hols the inpout type
	 *
	 * @var string
	 */
	protected $field_type = Input_Number::class;

	/**
	 * Rendered isntance of the field.
	 *
	 * @var Input_Number
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Number::create( 'key', 'label' );
	}

	/**
	 * Test the setting of autocomplete.
	 *
	 * @return void
	 */
	public function test_number_attribute_helpers(): void {

		// Set
		self::$field->min( 0 );
		self::$field->max( 10 );
		self::$field->step( 2.5 );

		// Get
		$this->assertEquals( 0, self::$field->get_min() );
		$this->assertEquals( 10, self::$field->get_max() );
		$this->assertEquals( 2.5, self::$field->get_step() );
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field
		    ->min( 0 )
		    ->max( 10 )
		    ->step( 2.5 )
			->generate_field_html();

		$this->assertStringContainsString( 'type="number"', $html );
		$this->assertStringContainsString( 'min="0"', $html );
		$this->assertStringContainsString( 'max="10"', $html );
		$this->assertStringContainsString( 'step="2.5"', $html );
	}
}

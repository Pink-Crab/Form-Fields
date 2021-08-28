<?php

declare(strict_types=1);

/**
 * Input with type Submit tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Fields\Input_Submit;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Button_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Submit extends TestCase {


	/**
	 * Hols the input type
	 *
	 * @var string
	 */
	protected $field_type = Input_Submit::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Abstract_Field
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests, Trait_Button_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Submit::create( 'key' );
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field->as_string();
		$this->assertStringContainsString( 'type="submit"', $html );
	}

	/**
	 * Test that the value value can be set/get/rendered.
	 *
	 * @return void
	 */
	public function test_can_set_unset_value() {
		$value = Input_Submit::create( 'value' )->value( 'save' );
		$this->assertEquals( 'save', $value->get_value() );

		$this->assertStringContainsString( 'value="save"', $value->as_string() );

		// Test can clear with blank value.
		$this->assertEquals( '', Input_Submit::create( 'value_default' )->get_value() );
	}

}

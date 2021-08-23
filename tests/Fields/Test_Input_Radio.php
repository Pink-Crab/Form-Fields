<?php

declare(strict_types=1);

/**
 * Input with type CHECKBOX tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use WP_UnitTestCase;
use PinkCrab\Form_Fields\Fields\Input_Radio;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Checked_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Multiple_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Radio extends WP_UnitTestCase {



	/**
	 * Hols the inpout type
	 *
	 * @var string
	 */
	protected $field_type = Input_Radio::class;

	/**
	 * Rendered isntance of the field.
	 *
	 * @var Input_Radio
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	// use Trait_General_Field_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Radio::create( 'key' )
			->options(
				array(
					'a' => 'alpa',
					'b' => 'bravo',
				)
			);
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field->as_string();
		$this->assertEquals( 2, substr_count( $html, 'name="key"' ) );
		$this->assertEquals( 2, substr_count( $html, 'type="radio"' ) );
		$this->assertStringContainsString( 'id="key[a]"', $html );
		$this->assertStringContainsString( 'value="a"', $html );
		$this->assertStringContainsString( 'id="key[b]"', $html );
		$this->assertStringContainsString( 'value="b"', $html );
	}

	/**
	 * Test can set the checked values using current()
	 *
	 * @return void
	 */
	public function test_can_denote_checked(): void {
		$html = self::$field
			->current( 'a' );
		$this->assertEquals( 1, substr_count( $html->as_string(), 'CHECKED' ) );
		$this->assertStringContainsString( 'value="a" CHECKED', $html->as_string() );
	}

	/**
	 * Test each radio box has its own label.
	 *
	 * @return void
	 */
	public function test_each_has_label(): void {
		$html = self::$field
			->show_label()
			->as_string();
		$this->assertEquals( 2, substr_count( $html, '<label for' ) );
		$this->assertStringContainsString( 'for="a">alpa', $html );
		$this->assertStringContainsString( 'for="b">bravo', $html );

	}

	/**
	 * Test all inputs are made disabled.
	 *
	 * @return void
	 */
	public function test_can_make_input_disabled(): void {
		$html = self::$field
			->disabled()
			->as_string();
		$this->assertEquals( 2, substr_count( $html, 'DISABLED' ) );
	}

	/**
	 * Test all inputs can have classes applied.
	 *
	 * @return void
	 */
	public function test_input_classes(): void {
		$html = self::$field
			->class( 'test-class' )
			->as_string();
		$this->assertEquals( 2, substr_count( $html, 'class="test-class"' ) );
	}

	/**
	 * Test all inputs can have attributes applied.
	 *
	 * @return void
	 */
	public function test_input_attributes(): void {
		$html = self::$field
			->attribute( 'data-test', '42' )
			->as_string();
		$this->assertEquals( 2, substr_count( $html, 'data-test="42"' ) );
	}

	/**
	 * Test all inputs are read only
	 *
	 * @return void
	 */
	public function test_input_readonly(): void {
		$html = self::$field
			->read_only()
			->as_string();
		$this->assertEquals( 2, substr_count( $html, 'readonly="readonly' ) );
	}
}

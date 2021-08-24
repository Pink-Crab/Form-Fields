<?php

declare(strict_types=1);

/**
 * Input with type RANGE tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use WP_UnitTestCase;
use PinkCrab\Form_Fields\Fields\Select;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Multiple_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Placeholder_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Select extends WP_UnitTestCase {

	use Trait_General_Field_Tests,
		Trait_Multiple_Tests,
		Trait_Placeholder_Tests;

	/**
	 * Hols the inpout type
	 *
	 * @var string
	 */
	protected $field_type = Select::class;

	/**
	 * Rendered isntance of the field.
	 *
	 * @var Select
	 */
	protected static $field;


	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Select::create( 'key' );
	}

	/**
	 * Ensure placehold is added as the first value, with no key.
	 *
	 * @return void
	 */
	public function test_placeholder_added_to_options(): void {
		$html = self::$field
			->placeholder( 'PLACEHOLDER' )
			->as_string();
		$this->assertStringContainsString( 'option value="">PLACEHOLDER</option>', $html );
	}

	/**
	 * Check that ungrouped options can be added.
	 *
	 * @return void
	 */
	public function test_can_add_options(): void {
		$html = self::$field
			->options(
				array(
					'a' => 'Alpha',
					'b' => 'Bravo',
				)
			)
			->as_string();

		$this->assertStringContainsString( '<option value="a">Alpha</option>', $html );
		$this->assertStringContainsString( '<option value="b">Bravo</option>', $html );
	}

	/**
	 * Check that groups can be rendered.
	 *
	 * @return void
	 */
	public function test_can_create_option_group(): void {
		$html = self::$field
			->options(
				array(
					'Primary Group'   => array(
						'a' => 'Alpha',
						'b' => 'Bravo',
					),
					'Secondary Group' => array(
						'c' => 'Charlie',
						'd' => 'Delta',
					),
				)
			)
			->as_string();

			// Check groups
			$this->assertStringContainsString( '<optgroup label="Primary Group">', $html );
			$this->assertStringContainsString( '<optgroup label="Secondary Group">', $html );

			// Check options
			$this->assertStringContainsString( '<option value="a">Alpha</option>', $html );
			$this->assertStringContainsString( '<option value="b">Bravo</option>', $html );
			$this->assertStringContainsString( '<option value="c">Charlie</option>', $html );
			$this->assertStringContainsString( '<option value="d">Delta</option>', $html );
	}

	/**
	 * Test that a selected value can be denoted with the attribute
	 *
	 * @return void
	 */
	public function test_selected_is_rendered(): void {
		$html = self::$field
			->options(
				array(
					'a' => 'Alpha',
					'b' => 'Bravo',
				)
			)
			->current( 'a' )
			->as_string();

			$this->assertStringContainsString( 'value="a" SELECTED="selected"', $html );
	}

	/**
	 * Can define multiple selected values.
	 *
	 * @return void
	 */
	public function test_can_select_multiple(): void {
		$html = self::$field
			->options(
				array(
					'a' => 'Alpha',
					'b' => 'Bravo',
				)
			)
			->current( array( 'a', 'b' ) )
			->as_string();

			$this->assertStringContainsString( 'value="a" SELECTED="selected"', $html );
			$this->assertStringContainsString( 'value="b" SELECTED="selected"', $html );
	}

	/**
	 * Test can set and get the current value.
	 *
	 * @return void
	 */
	public function test_current_value(): void {
		// /** @var Abstract_Field self::$field */
		self::$field->current( 'CURRENT' );
		$this->assertContains( 'CURRENT', self::$field->get_current() );
		$this->assertNotContains( 'NOTCURRENT', self::$field->get_current() );
	}
}

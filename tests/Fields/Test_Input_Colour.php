<?php

declare(strict_types=1);

/**
 * Input with type COLOUR tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use WP_UnitTestCase;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Fields\Input_Color;
use PinkCrab\Form_Fields\Fields\Input_Colour;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Pattern_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Placeholder_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Autocomplete_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Colour extends WP_UnitTestCase {

	/**
	 * Holds the input type
	 *
	 * @var string
	 */
	protected $field_type = Input_Colour::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Abstract_Field
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests,
		Trait_Placeholder_Tests,
		Trait_Autocomplete_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Colour::create( 'key' );
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field->as_string();
		$this->assertStringContainsString( 'type="color"', $html );
	}

	/**
	 * Input_Color should be an alias for Input_Colour
	 *
	 * @return void
	 */
	public function test_color_alias(): void {
		$colour = Input_Colour::create( 'key' )->current( '#fff' );
		$color  = Input_Color::create( 'key' )->current( '#fff' );

		$this->assertEquals( $colour->as_string(), $color->as_string() );
	}
}

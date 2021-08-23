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
use PinkCrab\Form_Fields\Fields\Input_Text;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Pattern_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Placeholder_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Autocomplete_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Text extends WP_UnitTestCase {


	/**
	 * Hols the inpout type
	 *
	 * @var string
	 */
	protected $field_type = Input_Text::class;

	/**
	 * Rendered isntance of the field.
	 *
	 * @var Input_Text
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests, 
		Trait_Placeholder_Tests, 
		Trait_Autocomplete_Tests,
		Trait_Pattern_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
//		
parent::setup();
		self::$field = Input_Text::create( 'key' );
	}

	/**
	 * Test the setting of autocomplete.
	 *
	 * @return void
	 */
	public function test_autocomplete(): void {

		// Custom value
		self::$field->autocomplete( 'name' );
		$this->assertArrayHasKey( 'autocomplete', self::$field->get_attributes() );
		$this->assertEquals( 'name', self::$field->get_attributes()['autocomplete'] );

		// No args passed = on
		self::$field->autocomplete();
		$this->assertEquals( 'on', self::$field->get_attributes()['autocomplete'] );
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field
			->disabled()
			->autocomplete( 'name' )
			->class( 'style' )
			->placeholder( 'the placeholder' )
			->current( 'current_val' )
			->read_only()
			->attribute( 'att1', 'val1' )
			->attribute( 'att2', 'val2' )
			->as_string();

		$this->assertStringContainsString( '<input', $html );
		$this->assertStringContainsString( 'DISABLED', $html );
		$this->assertStringContainsString( 'type="text"', $html );
		$this->assertStringContainsString( 'name="key"', $html );
		$this->assertStringContainsString( 'autocomplete="name"', $html );
		$this->assertStringContainsString( 'placeholder="the placeholder"', $html );
		$this->assertStringContainsString( 'value="current_val"', $html );
		$this->assertStringContainsString( 'readonly="readonly"', $html );
		$this->assertStringContainsString( 'att1="val1"', $html );
		$this->assertStringContainsString( 'att2="val2"', $html );
	}
}

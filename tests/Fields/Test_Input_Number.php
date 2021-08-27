<?php

declare(strict_types=1);

/**
 * Input with type NUMBER tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use WP_UnitTestCase;
use PinkCrab\Form_Fields\Fields\Input_Number;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Pattern_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Placeholder_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Autocomplete_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Number extends WP_UnitTestCase {


	/**
	 * Hols the inpout type
	 *
	 * @var string
	 */
	protected $field_type = Input_Number::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Input_Number
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
		self::$field = Input_Number::create( 'key');
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
			->as_string();

		$this->assertStringContainsString( 'type="number"', $html );
		$this->assertStringContainsString( 'min="0"', $html );
		$this->assertStringContainsString( 'max="10"', $html );
		$this->assertStringContainsString( 'step="2.5"', $html );
	}
}

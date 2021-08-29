<?php

declare(strict_types=1);

/**
 * Input with type WEEK tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PinkCrab\Form_Fields\Fields\Input_Week;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Range_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Pattern_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Datalist_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Autocomplete_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Week extends TestCase {


	/**
	 * Hols the input type
	 *
	 * @var string
	 */
	protected $field_type = Input_Week::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Input_Week
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests, 
		Trait_Pattern_Tests, 
		Trait_Range_Tests,
		Trait_Autocomplete_Tests, 
		Trait_Datalist_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Week::create( 'key');
	}


	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field
		    ->min( '01-01-2020' )
		    ->max( '12-12-2020' )
			->as_string();

		$this->assertStringContainsString( 'type="week"', $html );
		$this->assertStringContainsString( 'min="01-01-2020"', $html );
		$this->assertStringContainsString( 'max="12-12-2020"', $html );
	}
}

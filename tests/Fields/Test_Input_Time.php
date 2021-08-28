<?php

declare(strict_types=1);

/**
 * Input with type DATE tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PinkCrab\Form_Fields\Fields\Input_Time;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Range_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Pattern_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Datalist_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Time extends TestCase {


	/**
	 * Hols the input type
	 *
	 * @var string
	 */
	protected $field_type = Input_Time::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Input_Time
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests, 
		Trait_Pattern_Tests, Trait_Range_Tests, Trait_Datalist_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Time::create( 'key');
	}


	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field
		    ->min( '12:00' )
		    ->max( '18:00' )
			->pattern('[0-9]{2}:[0-9]{2}')
			->as_string();

		$this->assertStringContainsString( 'type="time"', $html );
		$this->assertStringContainsString( 'min="12:00"', $html );
		$this->assertStringContainsString( 'max="18:00"', $html );
		$this->assertStringContainsString( 'pattern="[0-9]{2}:[0-9]{2}"', $html );
	}
}

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

use PHPUnit\Framework\TestCase;
use PinkCrab\Form_Fields\Fields\Input_Range;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Range_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Datalist_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Placeholder_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Range extends TestCase {


	/**
	 * Hols the input type
	 *
	 * @var string
	 */
	protected $field_type = Input_Range::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Input_Range
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests,
		Trait_Placeholder_Tests,
		Trait_Range_Tests,
		Trait_Datalist_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Range::create( 'key' );
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

		$this->assertStringContainsString( 'type="range"', $html );
		$this->assertStringContainsString( 'min="0"', $html );
		$this->assertStringContainsString( 'max="10"', $html );
		$this->assertStringContainsString( 'step="2.5"', $html );
	}

	/**
	 * Tests that a list is added when options are used.
	 *
	 * @param Type $var
	 * @return void
	 */
	public function test_with_markers_from_options() {
		$html = self::$field
			->min( 0 )
			->max( 100 )
			->step( 10 )
			->options(
				array(
					'0'   => '0%',
					'10'  => '',
					'20'  => '20%',
					'30'  => '',
					'40'  => '40%',
					'50'  => '',
					'60'  => '60%',
					'70'  => '',
					'80'  => '80%',
					'90'  => '',
					'100' => '100%',
				)
			)
			->as_string();

		$this->assertStringContainsString( 'list="_key__list"', $html );
		$this->assertStringContainsString( '<datalist id="_key__list">', $html );
		$this->assertStringContainsString( 'value="0" label="0%"', $html );
		$this->assertStringContainsString( 'value="10"', $html );
		$this->assertStringContainsString( 'value="70"', $html );
		$this->assertStringContainsString( 'value="100" label="100%"', $html );
	}
}

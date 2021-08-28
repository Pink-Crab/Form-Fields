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
use PinkCrab\Form_Fields\Fields\Textarea;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Placeholder_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Autocomplete_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Textarea extends TestCase {


	/**
	 * Hols the input type
	 *
	 * @var string
	 */
	protected $field_type = Textarea::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Textarea
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
		self::$field = Textarea::create( 'key' );
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field
			->columns( 80 )
			->rows( 10 )
			->as_string();

		$this->assertStringContainsString( '<textarea', $html );
		$this->assertStringContainsString( 'cols="80"', $html );
		$this->assertStringContainsString( 'rows="10"', $html );
	}

	/**
	 * Test current valus is added and not set as an attribute.
	 *
	 * @return void
	 */
	public function test_with_markers_from_options(): void {
		$html = self::$field
			->current( 'CURRENT' )
			->as_string();

		$this->assertStringContainsString( 'CURRENT', $html );
		$this->assertStringNotContainsString( 'value="CURRENT"', $html );
		$this->assertStringNotContainsString( 'value="', $html );
	}
}

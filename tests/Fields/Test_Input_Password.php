<?php

declare(strict_types=1);

/**
 * Input with type PASSWORD tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use WP_UnitTestCase;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Fields\Input_Password;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Pattern_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Placeholder_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Autocomplete_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Password extends WP_UnitTestCase {


	/**
	 * Hols the inpout type
	 *
	 * @var string
	 */
	protected $field_type = Input_Password::class;

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
		Trait_Autocomplete_Tests,
		Trait_Pattern_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Password::create( 'key');
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field->as_string();
		$this->assertStringContainsString( 'type="password"', $html );
	}
}

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

use PHPUnit\Framework\TestCase;
use PinkCrab\Form_Fields\Fields\Input_Checkbox;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Checked_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Checkbox extends TestCase {

	/**
	 * Holds the input type
	 *
	 * @var string
	 */
	protected $field_type = Input_Checkbox::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Input_Checkbox
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests, Trait_Checked_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Checkbox::create( 'key' );
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field->checked( true )->as_string();
		$this->assertStringContainsString( 'CHECKED', $html );
	}
}

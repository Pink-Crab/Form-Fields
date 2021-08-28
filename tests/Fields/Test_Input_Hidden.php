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

use PHPUnit\Framework\TestCase;
use PinkCrab\Form_Fields\Fields\Input_Hidden;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Hidden extends TestCase {


	/**
	 * Hols the input type
	 *
	 * @var string
	 */
	protected $field_type = Input_Hidden::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Input_Hidden
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Hidden::create( 'key');
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field->as_string();
		$this->assertStringContainsString( 'type="hidden"', $html );
	}
}

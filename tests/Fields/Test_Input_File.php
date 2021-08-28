<?php

declare(strict_types=1);

/**
 * Input with type File tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use WP_UnitTestCase;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Fields\Input_File;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Multiple_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_File extends WP_UnitTestCase {


	/**
	 * Hols the input type
	 *
	 * @var string
	 */
	protected $field_type = Input_File::class;

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
		Trait_Multiple_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_File::create( 'key' );
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field->as_string();
		$this->assertStringContainsString( 'type="file"', $html );
	}

	/**
	 * Test that the accept value can be set/get/rendered.
	 *
	 * @return void
	 */
	public function test_can_set_unset_accept() {
		$accept = Input_File::create( 'accept' )->accept( '.gif' );
		$this->assertEquals( '.gif', $accept->get_accept() );

		$this->assertStringContainsString( 'accept=".gif"', $accept->as_string() );

		// Test can clear with blank value.
		$this->assertEquals( '', $accept->accept()->get_accept() );
	}

	/**
	 * Test that the capture value can be set/get/rendered.
	 *
	 * @return void
	 */
	public function test_can_set_unset_capture() {
		$capture = Input_File::create( 'capture' )->capture( '.gif' );
		$this->assertEquals( '.gif', $capture->get_capture() );

		$this->assertStringContainsString( 'capture=".gif"', $capture->as_string() );

		// Test can clear with blank value.
		$this->assertEquals( '', $capture->capture()->get_capture() );
	}
}

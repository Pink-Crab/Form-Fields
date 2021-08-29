<?php

declare(strict_types=1);

/**
 * Input with type Image tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use PHPUnit\Framework\TestCase;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Fields\Input_Image;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_Button_Tests;
use PinkCrab\Form_Fields\Tests\Trait_Test_Cases\Trait_General_Field_Tests;

class Test_Input_Image extends TestCase {


	/**
	 * Hols the input type
	 *
	 * @var string
	 */
	protected $field_type = Input_Image::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Abstract_Field
	 */
	protected static $field;

	/**
	 * Include all shared tests via trait.
	 */
	use Trait_General_Field_Tests, Trait_Button_Tests;

	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Image::create( 'key' );
	}

	/**
	 * Test the rendered HTML contains the defined values & Keys
	 *
	 * @return void
	 */
	public function test_html_has_expected_properties(): void {
		$html = self::$field->as_string();
		$this->assertStringContainsString( 'type="image"', $html );
	}

	/**
	 * Test that the src value can be set/get/rendered.
	 *
	 * @return void
	 */
	public function test_can_set_unset_src() {
		$src = Input_Image::create( 'src' )->src( 'foo.gif' );
		$this->assertEquals( 'foo.gif', $src->get_src() );

		$this->assertStringContainsString( 'src="foo.gif"', $src->as_string() );

		// Test can clear with blank value.
		$this->assertEquals( '', $src->src()->get_src() );
	}

	/**
	 * Test that the alt value can be set/get/rendered.
	 *
	 * @return void
	 */
	public function test_can_set_unset_alt() {
		$alt = Input_Image::create( 'alt' )->alt( 'some gif' );
		$this->assertEquals( 'some gif', $alt->get_alt() );

		$this->assertStringContainsString( 'alt="some gif"', $alt->as_string() );

		// Test can clear with blank value.
		$this->assertEquals( '', $alt->alt()->get_alt() );
	}

	/**
	 * Test that the height value can be set/get/rendered.
	 *
	 * @return void
	 */
	public function test_can_set_unset_height() {
		$height = Input_Image::create( 'height' )->height( '200' );
		$this->assertEquals( '200', $height->get_height() );

		$this->assertStringContainsString( 'height="200"', $height->as_string() );

		// Test can clear with blank value.
		$this->assertEquals( '', $height->height()->get_height() );
	}

	/**
	 * Test that the width value can be set/get/rendered.
	 *
	 * @return void
	 */
	public function test_can_set_unset_width() {
		$width = Input_Image::create( 'width' )->width( '550' );
		$this->assertEquals( '550', $width->get_width() );

		$this->assertStringContainsString( 'width="550"', $width->as_string() );

		// Test can clear with blank value.
		$this->assertEquals( '', $width->width()->get_width() );
	}
}

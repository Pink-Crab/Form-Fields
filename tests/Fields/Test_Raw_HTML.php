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

use WP_UnitTestCase;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Fields\Raw_HTML;

class Test_Raw_HTML extends WP_UnitTestCase {


	/**
	 * Hols the input type
	 *
	 * @var string
	 */
	protected $field_type = Raw_HTML::class;

	/**
	 * Rendered instance of the field.
	 *
	 * @var Raw_HTML
	 */
	protected static $field;


	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Raw_HTML::create( 'key' );
	}

	/**
	 * Test a simple html string can be returned.
	 *
	 * @return void
	 */
	public function test_custom_html_rendered(): void {
		$html = self::$field->content(
			function( Abstract_Field $field ): string {
				return '<p>Hello World</p>';
			}
		)->as_string();

		$this->assertEquals( '<p>Hello World</p>', $html );
	}

	/**
	 * Test can use input properties in the callback for content.
	 *
	 * @return void
	 */
	public function test_can_use_input_properties_in_callback() {
		$html = self::$field
			->current( 'foo' )
			->content(
				function( Abstract_Field $field ): string {
					return $field->get_current();
				}
			)
			->as_string();
		$this->assertEquals( 'foo', $html );
	}

	/**
	 * Test can include a label with html
	 *
	 * @return void
	 */
	public function test_can_include_label(): void {
		$html = self::$field
			->label( 'test' )
			->show_label()
			->content(
				function( Abstract_Field $field ): string {
					return '<p>Hello World</p>';
				}
			)
			->as_string();
		
		$this->assertStringContainsString( 'label for="key"', $html );
	}
}

<?php

declare(strict_types=1);

/**
 * Trait containing tests for all shared properties and setter/getters
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Trait_Test_Cases;

use Gin0115\WPUnit_Helpers\Output;
use Gin0115\WPUnit_Helpers\Objects;

trait Trait_General_Field_Tests {

	/**
	 * Test get key
	 *
	 * @return void
	 */
	public function test_field_key(): void {
		$this->assertEquals( 'key', self::$field->get_key() );
	}

	public function test_custom_name(): void {
		$this->assertEquals( 'name', self::$field->name( 'name' )->get_name() );
	}

	/**
	 * Test can set and get the current value.
	 *
	 * @return void
	 */
	public function test_current_value(): void {
		/** @var Abstract_Field self::$field */
		self::$field->current( 'CURRENT' );
		$this->assertArrayHasKey( 'value', self::$field->get_attributes() );
		$this->assertEquals( 'CURRENT', self::$field->get_attributes()['value'] );
		$this->assertNotEquals( 'NOTCURRENT', self::$field->get_attributes()['value'] );

		// Unset current with empty values.
		self::$field->current( '' );
		$this->assertFalse( array_key_exists( 'value', self::$field->get_attributes() ) );
	}

	/**
	 * Test can toggle is disabled.
	 *
	 * @return void
	 */
	public function test_disabled(): void {

		// As True
		self::$field->disabled( true );
		$this->assertTrue( self::$field->get_disabled() );

		// As False
		self::$field->disabled( false );
		$this->assertFalse( self::$field->get_disabled() );

		// TRUE by defualt if no arg passed
		self::$field->disabled();
		$this->assertTrue( self::$field->get_disabled() );

	}

	/**
	 * Test can set and get the type
	 *
	 * @return void
	 */
	public function test_type(): void {
		// This is used when creating a new Field, can only be called internally.
		Objects::invoke_method( self::$field, 'type', array( 'type' ) );
		$this->assertEquals( 'type', self::$field->get_type() );
		$this->assertNotEquals( 'NOTtype', self::$field->get_type() );
	}
	/**
	 * Test can set and get the class
	 *
	 * @return void
	 */
	public function test_class(): void {
		self::$field->class( 'class' );
		$this->assertEquals( 'class', self::$field->get_class() );
		$this->assertNotEquals( 'NOTclass', self::$field->get_class() );
	}


	/**
	 * Test can set and get the description
	 *
	 * @return void
	 */
	public function test_description(): void {
		self::$field->description( 'description' );
		$this->assertEquals( 'description', self::$field->get_description() );
		$this->assertNotEquals( 'NOTdescription', self::$field->get_description() );
	}

	/**
	 * Test can set and get the label
	 *
	 * @return void
	 */
	public function test_label(): void {
		self::$field->label( 'label' );
		$this->assertEquals( 'label', self::$field->get_label() );
		$this->assertNotEquals( 'NOTlabel', self::$field->get_label() );
	}


	/**
	 * Test can toggle is show_label.
	 *
	 * @return void
	 */
	public function test_show_label(): void {

		self::$field->label( 'label' );

		// As True
		self::$field->show_label( true );
		$this->assertTrue( self::$field->label_config()->is_visible() );

		// As False
		self::$field->show_label( false );
		$this->assertFalse( self::$field->label_config()->is_visible() );

		// TRUE by defualt if no arg passed
		self::$field->show_label();
		$this->assertTrue( self::$field->label_config()->is_visible() );

	}

	/**
	 * Test can set and get the attributes
	 *
	 * @return void
	 */
	public function test_set_attributes(): void {
		self::$field->set_attributes( array( 'key' => 'attributes' ) );
		$this->assertEquals( array( 'key' => 'attributes' ), self::$field->get_attributes() );
		$this->assertNotEquals( 'NOTattributes', self::$field->get_attributes() );
	}

	/**
	 * Test can set a single attribute
	 *
	 * @return void
	 */
	public function test_attribute_single(): void {
		self::$field->attribute( 'key', 'attribute' );
		$this->assertEquals( array( 'key' => 'attribute' ), self::$field->get_attributes() );
		$this->assertNotEquals( array( 'key' => 'NOTattribute' ), self::$field->get_attributes() );
	}

	/** @testdox It should be possible to render the HTML direct to the output. */
	public function test_render_field(): void {
		self::$field
			->attribute( 'key', 'attribute' )
			->label( 'label' )
			->class( 'class' )
			->name( 'name' )
			->show_label();

		$html = Output::buffer(
			function() {
				self::$field->render();
			}
		);

		$html = str_replace( "\r\n", '', $html );
		$html = str_replace( \PHP_EOL, '', $html );
		$this->assertStringContainsString( 'key="attribute"', $html );
		$this->assertStringContainsString( '<label for="key">label', $html );
		$this->assertStringContainsString( 'class="class"', $html );
		$this->assertStringContainsString( 'name="name"', $html );
	}

	/** @testdox It should be possible to return the field as HTML for printing later. */
	public function test_print_field(): void {
		self::$field
			->attribute( 'key', 'attribute' )
			->label( 'label' )
			->class( 'class' )
			->name( 'name' )
			->show_label();

		$html = self::$field->as_string();

		$html = str_replace( "\r\n", '', $html );
		$html = str_replace( \PHP_EOL, '', $html );
		$this->assertStringContainsString( 'key="attribute"', $html );
		$this->assertStringContainsString( '<label for="key">label', $html );
		$this->assertStringContainsString( 'class="class"', $html );
		$this->assertStringContainsString( 'name="name"', $html );
	}

	/** @testdox It should be possible to set and unset the field as read only. */
	public function test_set_read_only(): void {
		// Set with empty
		self::$field->read_only();
		$this->assertEquals( array( 'readonly' => 'readonly' ), self::$field->get_attributes() );

		// Unset
		self::$field->read_only( false );
		$this->assertEmpty( self::$field->get_attributes() );

		// Set with strict true
		self::$field->read_only( true );
		$this->assertEquals( array( 'readonly' => 'readonly' ), self::$field->get_attributes() );

		// Should render.
		$this->assertStringContainsString( 'readonly="readonly"', self::$field->as_string() );
	}

	/** @testdox If an array is set as an attribute, skip. */
	public function test_skip_rendering_attribute_if_an_array() {
		self::$field->set_attributes( array( 'test' => array( 'array' ) ) );
		$this->assertEquals( '', self::$field->render_attributes() );
	}

	/** @testdox Whenever adding a label to an input, the visibility should be set if the length is greater than 1 */
	public function test_auto_show_label_none_empty_string() {
		self::$field->label( 'Im a label' );
		$this->assertTrue( self::$field->label_config()->is_visible() );
	}

	/** @testdox Whenever adding a label to an input, the visibility should be set hidden if the length is empty */
	public function test_auto_hide_label_empty_string() {
		self::$field->show_label()->label( '' );
		$this->assertFalse( self::$field->label_config()->is_visible() );
	}
}

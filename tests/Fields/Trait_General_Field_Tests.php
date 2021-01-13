<?php

declare(strict_types=1);

/**
 * Trait containing tests for all shared properties and setter/getters
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

trait Trait_General_Field_Tests {

	/**
	 * Test get key
	 *
	 * @return void
	 */
	public function test_field_key(): void {
		$this->assertEquals( 'key', self::$field->get_key() );
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
		self::$field->type( 'type' );
		$this->assertEquals( 'type', self::$field->get_type() );
		$this->assertNotEquals( 'NOTtype', self::$field->get_type() );
	}

	/**
	 * Test can set and get the default
	 *
	 * @return void
	 */
	public function test_default(): void {
		self::$field->default( (object) array( 'default' ) );
		$this->assertEquals( (object) array( 'default' ), self::$field->get_default() );
		$this->assertNotEquals( 'NOTdefault', self::$field->get_default() );
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
	 * Test can set and get the placeholder
	 *
	 * @return void
	 */
	public function test_placeholder(): void {
		self::$field->placeholder( 'placeholder' );
		$this->assertArrayHasKey( 'placeholder', self::$field->get_attributes() );
		$this->assertEquals( 'placeholder', self::$field->get_attributes()['placeholder'] );
		$this->assertNotEquals( 'NOTplaceholder', self::$field->get_attributes()['placeholder'] );
	}

	/**
	 * Test can set and get the options
	 *
	 * @return void
	 */
	public function test_options(): void {
		self::$field->options( array( 'key' => 'options' ) );
		$this->assertEquals( array( 'key' => 'options' ), self::$field->get_options() );
		$this->assertNotEquals( 'NOToptions', self::$field->get_options() );
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


	// /**
	//  * Test can toggle is include_label.
	//  *
	//  * @return void
	//  */
	// public function test_include_label(): void {

	// 	// As True
	// 	self::$field->include_label( true );
	// 	$this->assertTrue( self::$field->get_include_label() );

	// 	// As False
	// 	self::$field->include_label( false );
	// 	$this->assertFalse( self::$field->get_include_label() );

	// 	// TRUE by defualt if no arg passed
	// 	self::$field->include_label();
	// 	$this->assertTrue( self::$field->get_include_label() );

	// }

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
}

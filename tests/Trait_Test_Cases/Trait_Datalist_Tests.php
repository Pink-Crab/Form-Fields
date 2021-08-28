<?php

declare(strict_types=1);

/**
 * Trait containing tests for all Datalist functionality
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Trait_Test_Cases;

use Gin0115\WPUnit_Helpers\Objects;

trait Trait_Datalist_Tests {

	/** @testdox The Datalist key should have a default key */
	public function test_default_datalist_key(): void {
		$this->assertEquals( '_key__list', Objects::invoke_method( self::$field, 'get_datalist_key' ) );
	}

	/** @testdox It should be possible to set the link between the datalist and the input field, using values from the field. */
	public function test_datalist_key_templates(): void {
		self::$field->datalist_key( '{key}' );
		$this->assertEquals( 'key', Objects::invoke_method( self::$field, 'get_datalist_key' ) );

		// Set wih a custom name.
		self::$field
			->name( 'custom_name' ) // Set a name
			->datalist_key( '{name}' ); // Set the template to just the fields name.
		$this->assertEquals( 'custom_name', Objects::invoke_method( self::$field, 'get_datalist_key' ) );

		// Use hash of field.
		self::$field->datalist_key( '{hash}' );
		$hash = \md5( \json_encode( self::$field ) );
		$this->assertEquals( $hash, Objects::invoke_method( self::$field, 'get_datalist_key' ) );
	}

	/** @testdox It should be possible to set single options, or as a full array. As the label attribute is optional, the option value should be optional in the API. */
	public function test_add_single_options(): void {
		// Single Values
		self::$field
			->option( 'key1', 'value1' )
			->option( 'key2' );

		$this->assertArrayHasKey( 'key1', self::$field->get_options() );
		$this->assertEquals( 'value1', self::$field->get_options()['key1'] );
		$this->assertArrayHasKey( 'key2', self::$field->get_options() );
		$this->assertEquals( '', self::$field->get_options()['key2'] );

		// As a group
		self::$field->options(
			array(
				'key3' => '',
				'key4' => 'value4',
			)
		);
		$this->assertArrayHasKey( 'key3', self::$field->get_options() );
		$this->assertEquals( '', self::$field->get_options()['key3'] );
		$this->assertArrayHasKey( 'key4', self::$field->get_options() );
		$this->assertEquals( 'value4', self::$field->get_options()['key4'] );
	}

	/** @testdox If no options are set, the datalist should not be rendered. */
	public function test_doesnt_render_if_no_options(): void {
		$this->assertEquals( '', self::$field->maybe_render_datalist() );
	}

	/** @testdox A field which has options should have a linked datalist element created and the key set to the fields attributes. */
	public function test_render_datalist(): void {
		self::$field->options(
			array(
				'key3' => '',
				'key4' => 'value4',
			)
		);
		self::$field->datalist_key( '{hash}' );
		$hash = \md5( \json_encode( self::$field ) );
		$html = self::$field->maybe_render_datalist();

		// Check values.
		$this->assertStringContainsString( sprintf( 'datalist id="%s"', $hash ), $html );
		$this->assertStringContainsString( 'option value="key3"', $html );
		$this->assertStringContainsString( 'option value="key4" label="value4"', $html );

		// Check datalist ID is set to the fields attributes.
		$this->assertArrayHasKey( 'list', self::$field->get_attributes() );
		$this->assertEquals( $hash, self::$field->get_attributes()['list'] );
		
		// Check in rendered field.
		$this->assertStringContainsString( sprintf( 'list="%s"', $hash ), self::$field->as_string() );
	}
}

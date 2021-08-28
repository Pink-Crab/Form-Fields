<?php

declare(strict_types=1);

/**
 * Trait containing tests for all Button functionality
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Trait_Test_Cases;

trait Trait_Button_Tests {


	/**
	 * Test the form_action settings
	 *
	 * @return void
	 */
	public function test_form_action_attribute(): void {

		// Set
		self::$field->form_action( 'action.php' );

		// Get
		$this->assertEquals( 'action.php', self::$field->get_form_action() );

		// In Attributes
		$this->assertArrayHasKey( 'formaction', self::$field->get_attributes() );
		$this->assertEquals( 'action.php', self::$field->get_attributes()['formaction'] );
		
		// Rendered
		$this->assertStringContainsString( 'formaction="action.php"', self::$field->as_string() );

		// Removed.
		self::$field->form_action( '' );
		$this->assertFalse( in_array( 'formaction', self::$field->get_attributes() ) );
		$this->assertStringNotContainsString( 'formaction', self::$field->as_string() );
	}

	/**
	 * Test the form_method settings
	 *
	 * @return void
	 */
	public function test_form_enctype_attribute(): void {

		// Set
		self::$field->form_enctype( 'text/plain' );

		// Get
		$this->assertEquals( 'text/plain', self::$field->get_form_enctype() );

		// In Attributes
		$this->assertArrayHasKey( 'formenctype', self::$field->get_attributes() );
		$this->assertEquals( 'text/plain', self::$field->get_attributes()['formenctype'] );
		
		// Rendered
		$this->assertStringContainsString( 'formenctype="text/plain"', self::$field->as_string() );

		// Removed.
		self::$field->form_enctype( '' );
		$this->assertFalse( in_array( 'formenctype', self::$field->get_attributes() ) );
		$this->assertStringNotContainsString( 'formenctype', self::$field->as_string() );

		// Attempting to set with any value but those allowed, will return in the value not being set.
		$this->assertEquals('application/x-www-form-urlencoded', self::$field->form_enctype('application/x-www-form-urlencoded')->get_form_enctype());
		$this->assertEquals('', self::$field->form_enctype('other')->get_form_enctype());
	}

	/**
	 * Test the form_method settings
	 *
	 * @return void
	 */
	public function test_form_method_attribute(): void {

		// Set
		self::$field->form_method( 'get' );

		// Get
		$this->assertEquals( 'get', self::$field->get_form_method() );

		// In Attributes
		$this->assertArrayHasKey( 'formmethod', self::$field->get_attributes() );
		$this->assertEquals( 'get', self::$field->get_attributes()['formmethod'] );
		
		// Rendered
		$this->assertStringContainsString( 'formmethod="get"', self::$field->as_string() );

		// Removed.
		self::$field->form_method( '' );
		$this->assertFalse( in_array( 'formmethod', self::$field->get_attributes() ) );
		$this->assertStringNotContainsString( 'formmethod', self::$field->as_string() );

		// Attempting to set with any value but POST and GET should not be set.
		$this->assertEquals('get', self::$field->form_method('get')->get_form_method());
		$this->assertEquals('post', self::$field->form_method('post')->get_form_method());
		$this->assertEquals('', self::$field->form_method('other')->get_form_method());
	}

	/**
	 * Test the form_novalidate settings
	 *
	 * @return void
	 */
	public function test_form_novalidate_attribute(): void {

		// Set
		self::$field->form_no_validate();

		// Get
		$this->assertEquals( 'formnovalidate', self::$field->get_form_no_validate() );

		// In Attributes
		$this->assertArrayHasKey( 'formnovalidate', self::$field->get_attributes() );
		$this->assertEquals( 'formnovalidate', self::$field->get_attributes()['formnovalidate'] );
		
		// Rendered
		$this->assertStringContainsString( 'formnovalidate="formnovalidate"', self::$field->as_string() );

		// Removed.
		self::$field->form_no_validate( false );
		$this->assertFalse( in_array( 'formnovalidate', self::$field->get_attributes() ) );
		$this->assertStringNotContainsString( 'formnovalidate', self::$field->as_string() );
	}

}

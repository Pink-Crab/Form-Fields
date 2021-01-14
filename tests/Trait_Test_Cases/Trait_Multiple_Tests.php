<?php

declare(strict_types=1);

/**
 * Trait containing tests for all Multiple functionality
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Trait_Test_Cases;


trait Trait_Multiple_Tests {
	
	/**
	 * Test can set and get the multiple
	 *
	 * @return void
	 */
	public function test_multiple(): void {

		// As True
		self::$field->multiple( true );
		$this->assertTrue( self::$field->is_multiple() );

		// As False
		self::$field->multiple( false );
		$this->assertFalse( self::$field->is_multiple() );

		// TRUE by defualt if no arg passed
		self::$field->multiple();
		$this->assertTrue( self::$field->is_multiple() );
	}
}

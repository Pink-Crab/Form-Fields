<?php

declare(strict_types=1);

/**
 * Trait containing tests for all Checked functionality
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Trait_Test_Cases;

use PinkCrab\PHPUnit_Helpers\Objects;

trait Trait_Checked_Tests {
	
	/**
	 * Test can set and get the checked
	 *
	 * @return void
	 */
	public function test_checked(): void {

		// As True
		self::$field->checked( true );
		$this->assertTrue( self::$field->is_checked() );

		// As False
		self::$field->checked( false );
		$this->assertFalse( self::$field->is_checked() );

		// TRUE by defualt if no arg passed
		self::$field->checked();
		$this->assertTrue( self::$field->is_checked() );
	}
}

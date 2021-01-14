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


trait Trait_Pattern_Tests {

	/**
	 * Test can set and get the pattern
	 *
	 * @return void
	 */
	public function test_pattern(): void {

		// With a value
		self::$field->pattern( '.{8,}' );
		$this->assertEquals( '.{8,}', self::$field->get_pattern() );

		// With empty or no pattern (return null)
		self::$field->pattern( '' );
		$this->assertNull( self::$field->get_pattern() );

		self::$field->pattern();
		$this->assertNull( self::$field->get_pattern() );
	}
}

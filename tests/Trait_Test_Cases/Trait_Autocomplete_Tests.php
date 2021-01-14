<?php

declare(strict_types=1);

/**
 * Trait containing tests for all Autocomplete functionality
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Trait_Test_Cases;

trait Trait_Autocomplete_Tests {

	/**
	 * Test can set and get the autocomplete
	 *
	 * @return void
	 */
	public function test_autocomplete(): void {
		self::$field->autocomplete( 'autocomplete' );
		$this->assertArrayHasKey( 'autocomplete', self::$field->get_attributes() );
		$this->assertEquals( 'autocomplete', self::$field->get_attributes()['autocomplete'] );
		$this->assertNotEquals( 'NOTautocomplete', self::$field->get_attributes()['autocomplete'] );

        // Test sets with on as defulat.
        self::$field->autocomplete();
		$this->assertEquals( 'on', self::$field->get_attributes()['autocomplete'] );
	}

}

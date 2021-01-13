<?php

declare(strict_types=1);

/**
 * Tests for the label config object.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests;

use WP_UnitTestCase;
use PinkCrab\Form_Fields\Label_Config;

class Test_Label_Config extends WP_UnitTestCase {

	/**
	 * Test the defaults are set as expected.
	 * Visible = false
	 * Wrap = true
	 * Above = true
	 *
	 * @return void
	 */
	public function test_defaults(): void {
		$label = new Label_Config;
		$this->assertFalse( $label->is_visible() );
		$this->assertTrue( $label->is_wrapped() );
		$this->assertTrue( $label->is_positioned_after() );
	}

	/**
	 * Test bitwise flags for positioning.
	 *
	 * @return void
	 */
	public function test_bitwise_position_flags(): void {

		/* 2 Values */

		// Wrapped & Above
		$label = new Label_Config;
		$label->set_position( Label_Config::WRAP_LABEL | Label_Config::BEFORE_INPUT );
		$this->assertTrue( $label->is_wrapped() );
		$this->assertTrue( $label->is_positioned_after() );

		// Wrapped & Below
		$label = new Label_Config;
		$label->set_position( Label_Config::WRAP_LABEL | Label_Config::AFTER_INPUT );
		$this->assertTrue( $label->is_wrapped() );
		$this->assertFalse( $label->is_positioned_after() );

		// Linked & Above
		$label = new Label_Config;
		$label->set_position( Label_Config::LINKED_LABEL | Label_Config::BEFORE_INPUT );
		$this->assertFalse( $label->is_wrapped() );
		$this->assertTrue( $label->is_positioned_after() );

		// Linked & Below
		$label = new Label_Config;
		$label->set_position( Label_Config::LINKED_LABEL | Label_Config::AFTER_INPUT );
		$this->assertFalse( $label->is_wrapped() );
		$this->assertFalse( $label->is_positioned_after() );

		/* 1 Value */

		// Wrapped
		$label = new Label_Config;
		$label->set_position( Label_Config::WRAP_LABEL );
		$this->assertTrue( $label->is_wrapped() );
		$this->assertTrue( $label->is_positioned_after() );

		// Linked
		$label = new Label_Config;
		$label->set_position( Label_Config::LINKED_LABEL );
		$this->assertFalse( $label->is_wrapped() );
		$this->assertTrue( $label->is_positioned_after() );

		// Above
		$label = new Label_Config;
		$label->set_position( Label_Config::BEFORE_INPUT );
		$this->assertTrue( $label->is_wrapped() );
		$this->assertTrue( $label->is_positioned_after() );

		// Below
		$label = new Label_Config;
		$label->set_position( Label_Config::AFTER_INPUT );
		$this->assertTrue( $label->is_wrapped() );
		$this->assertFalse( $label->is_positioned_after() );

		// Test overloading.
		$label->set_position(
			Label_Config::LINKED_LABEL
			| Label_Config::AFTER_INPUT
			| Label_Config::BEFORE_INPUT
			| Label_Config::WRAP_LABEL
		);
		$this->assertFalse( $label->is_wrapped() );
		$this->assertFalse( $label->is_positioned_after() );
	}

	/**
	 * Test that the visibility can be toggled.
	 *
	 * @return void
	 */
	public function test_visibility(): void {
		$label = new Label_Config;
		$label->visibility( true );
		$this->assertTrue( $label->is_visible() );

		// Set as false (hidden)
		$label->visibility( false );
		$this->assertFalse( $label->is_visible() );

	}

	/**
	 * Check the wrapped or linked can be set.
	 *
	 * @return void
	 */
	public function test_can_wrapped_or_linked(): void {
		$label = new Label_Config;
		$label->wrapped();
		$this->assertTrue( $label->is_wrapped() );

		// Set as linked
		$label->wrapped( false );
		$this->assertFalse( $label->is_wrapped() );
	}

	/**
	 * Check the position can be set to above or below.
	 *
	 * @return void
	 */
	public function test_can_position_label(): void {
		$label = new Label_Config;
		$label->position_after();
		$this->assertTrue( $label->is_positioned_after() );

		// Set as linked
		$label->position_after( false );
		$this->assertFalse( $label->is_positioned_after() );
	}

	/**
	 * Test label classes can be set.
	 *
	 * @return void
	 */
	public function test_can_set_label_classes(): void {
		$label = new Label_Config;
		$label->classes( 'test class' );
		$this->assertStringContainsString( 'test class', $label->get_classes() );

		// Set as linked
		$label->classes();
		$this->assertTrue( empty( $label->get_classes() ) );
	}

	/**
	 * Test the positioned above setter and getter
	 *
	 * @return void
	 */
	public function test_positioned_after(): void {
		$label = new Label_Config;
		$label->position_after( true );
		$this->assertTrue( $label->is_positioned_after() );

		$label = new Label_Config;
		$label->position_after( false );
		$this->assertFalse( $label->is_positioned_after() );
	}

	/**
	 * Tests the wrapped or inline setter and getter.
	 *
	 * @return void
	 */
	public function test_wrapped_label(): void {
        $label = new Label_Config;
		$label->wrapped( true );
		$this->assertTrue( $label->is_wrapped() );

		$label = new Label_Config;
		$label->wrapped( false );
		$this->assertFalse( $label->is_wrapped() );
	}


}

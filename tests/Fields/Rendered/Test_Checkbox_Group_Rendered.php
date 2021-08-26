<?php

declare(strict_types=1);

/**
 * Checkbox group rendering tests
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields\Rendered;

use WP_UnitTestCase;
use Symfony\Component\DomCrawler\Crawler;
use PinkCrab\Form_Fields\Fields\Checkbox_Group;

class Test_Checkbox_Group_Rendered extends WP_UnitTestCase {

	/** @testdox It should be possible to render a group with 2 values. */
	public function test_can_render_2_fields_no_current(): void {
		$field = Checkbox_Group::create( 'alpha' )
			->options(
				array(
					'A' => 'Apple',
					'B' => 'Banana',
				)
			);

		$fieldset = ( new Crawler( $field->as_string() ) )->filter( 'fieldset' );

		// Check we have 2 labels, wrapping inputs.
		$this->assertCount( 2, $fieldset->filter( 'label' ) );

		// Check the labels.
		$labels = $fieldset->filter( 'label' )->each(
			function ( $node, $i ) {
				return $node->text();
			}
		);
		$this->assertContains( 'Apple', $labels );
		$this->assertContains( 'Banana', $labels );

		$attributes = $fieldset->filter( 'input' )->extract( array( 'id', 'name', 'type', 'value' ) );
		// [ 0 => id, 1 => name, 2 => type, 3=> value ]

		// Check IDs
		$this->assertEquals( 'alpha[A]', $attributes[0][0] );
		$this->assertEquals( 'alpha[B]', $attributes[1][0] );

		// Check names
		$this->assertEquals( 'alpha[A]', $attributes[0][1] );
		$this->assertEquals( 'alpha[B]', $attributes[1][1] );

		// Check input type
		$this->assertEquals( 'checkbox', $attributes[0][2] );
		$this->assertEquals( 'checkbox', $attributes[1][2] );

		// Check selected value
		$this->assertEquals( 'on', $attributes[0][3] );
		$this->assertEquals( 'on', $attributes[1][3] );
	}

    /** @testdox It should be possible to render if a checkbox is already checked. */
	public function test_checks_selected_checkboxes() {
		$field = Checkbox_Group::create( 'checked' )
			->options(
				array(
					'A' => 'Apple',
					'B' => 'Banana',
					'C' => 'Cherry',
				)
			)->current( array( 'A', 'C' ) );

		$fieldset = ( new Crawler( $field->as_string() ) )->filter( 'fieldset' );

		// Ensure only A and C are marked as checked.
		$checked = $fieldset->filter( 'input:checked' )->extract( array( 'id' ) );
		$this->assertEquals( 'checked[A]', $checked[0] );
		$this->assertEquals( 'checked[C]', $checked[1] );

	}

	/** @testdox It should be possible to disable the entire group. */
	public function test_disabled_group() {
		$field = Checkbox_Group::create( 'foo' )
			->options( array( 'A' => 'Apple' ) )
			->disabled();

		$fieldset = ( new Crawler( $field->as_string() ) )->filter( 'fieldset' );

		$disabled = $fieldset->each(
			function ( $node, $i ) {
				return $node->attr( 'disabled' );
			}
		);

		$this->assertCount( 1, $disabled );
		$this->assertContains( 'disabled', $disabled );
	}

	/** @testdox It should be possible to set attributes that are defined on all fields. */
	public function test_can_set_attributes(): void {
		$field = Checkbox_Group::create( 'alpha' )
			->options( array( 'A' => 'Apple' ) )
			->attribute( 'data-foo', 'foo' )
			->attribute( 'data-bar', 'bar' );

		$fieldset = ( new Crawler( $field->as_string() ) )->filter( 'fieldset' );

		$attributes = $fieldset->first()->extract( array( 'data-foo', 'data-bar' ) );
		$this->assertContains( 'foo', $attributes[0] );
		$this->assertContains( 'bar', $attributes[0] );
	}


}

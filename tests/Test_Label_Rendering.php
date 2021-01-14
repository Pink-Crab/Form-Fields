<?php

declare(strict_types=1);

/**
 * Input with type RANGE tests.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Tests\Fields;

use DOMText;
use DOMDocument;
use PHPUnit\Framework\DOMTestCase;
use PinkCrab\Form_Fields\Label_Config;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Fields\Input_Number;

class Test_Label_Rendering extends DOMTestCase {


	/**
	 * Hols the inpout type
	 *
	 * @var string
	 */
	protected $field_type = Input_Number::class;

	/**
	 * Rendered isntance of the field.
	 *
	 * @var Input_Number
	 */
	protected static $field;


	/**
	 * Create new input.
	 *
	 * @return void
	 */
	public function setup(): void {
		parent::setup();
		self::$field = Input_Number::create( 'key' )
			->label( 'LABEL' )
			->show_label();
	}

	/**
	 * Strip new lines from field and returns as loaded html.
	 *
	 * @param string $html
	 * @return \DOMDocument
	 */
	public function domdoc_provider( string $html ): DOMDocument {
		$html = preg_replace( array( '/\r/', '/\n/' ), '', $html );
		$doc  = new DOMDocument();
		$doc->loadHTML( $html );
		return $doc;

	}

	/**
	 * Test that the label is rendered.
	 *
	 * @return void
	 */
	public function test_renders_label(): void {
		$html = self::$field->as_string();
		$this->assertStringContainsString( '<label for="key">', $html );
		$this->assertStringContainsString( 'LABEL', $html );
	}

	/**
	 * Test that label is wrapping input and label before input.
	 * Removes all linebreaks, to avoid nodes of \n
	 *
	 * @return void
	 */
	public function test_label_wraps_input_before() {

		$field = self::$field->as_string();

		$doc = $this->domdoc_provider( $field );

		// Assert only 1 node (Label wrapping Input).
		$this->assertCount( 1, $doc->getElementsByTagName( 'label' ) );

		// Assert we have 2 nodes (Text/Label Content and Input)
		$this->assertCount( 2, $doc->getElementsByTagName( 'label' )[0]->childNodes );

		$label_nodes = $doc->getElementsByTagName( 'label' )[0]->childNodes;

		// Assert First Node is #Text (Label Value)
		$this->assertInstanceOf( DOMText::class, $label_nodes[0] );
		// Assert Second Node is input
		$this->assertEquals( 'input', $label_nodes[1]->nodeName );

	}

	/**
	 * Test that label is wrapping input and label after input.
	 * Removes all linebreaks, to avoid nodes of \n
	 *
	 * @return void
	 */
	public function test_label_wraps_input_after() {

		$field = self::$field
				->label_position( Label_Config::AFTER_INPUT )
				->as_string();

		$doc = $this->domdoc_provider( $field );

		// Assert only 1 node (Label wrapping Input).
		$this->assertCount( 1, $doc->getElementsByTagName( 'label' ) );

		// Assert we have 2 nodes (Text/Label Content and Input)
		$this->assertCount( 2, $doc->getElementsByTagName( 'label' )[0]->childNodes );

		$label_nodes = $doc->getElementsByTagName( 'label' )[0]->childNodes;

		// Assert Firest Node is input
		$this->assertEquals( 'input', $label_nodes[0]->nodeName );
		// Assert Second Node is #Text (Label Value)
		$this->assertInstanceOf( DOMText::class, $label_nodes[1] );

	}

	/**
	 * Test that label is linked input and label before input.
	 * Removes all linebreaks, to avoid nodes of \n
	 *
	 * @return void
	 */
	public function test_label_linked_input_before() {

		$field = self::$field
			->label_position( Label_Config::LINKED_LABEL )
			->as_string();

		$doc = $this->domdoc_provider( $field );

		// Assert has 2 nodes (input and label).
		$this->assertCount( 2, $doc->getElementsByTagName( 'body' )[0]->childNodes );

		$label_nodes = $doc->getElementsByTagName( 'body' )[0]->childNodes;
		// Assert First Node is #Text (Label Value)
		$this->assertEquals( 'label', $label_nodes[0]->nodeName );
		// Assert Second Node is input
		$this->assertEquals( 'input', $label_nodes[1]->nodeName );

	}

	/**
	 * Test that label is linked input and label after input.
	 * Removes all linebreaks, to avoid nodes of \n
	 *
	 * @return void
	 */
	public function test_label_linked_input_after() {

		$field = self::$field
			->label_position( Label_Config::LINKED_LABEL | Label_Config::AFTER_INPUT )
			->as_string();

		$doc = $this->domdoc_provider( $field );

		// Assert has 2 nodes (input and label).
		$this->assertCount( 2, $doc->getElementsByTagName( 'body' )[0]->childNodes );

		$label_nodes = $doc->getElementsByTagName( 'body' )[0]->childNodes;
		// Assert First Node is input
		$this->assertEquals( 'input', $label_nodes[0]->nodeName );
		// Assert Second Node is #Text (Label Value)
		$this->assertEquals( 'label', $label_nodes[1]->nodeName );
	}
}

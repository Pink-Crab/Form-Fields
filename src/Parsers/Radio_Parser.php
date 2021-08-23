<?php

declare(strict_types=1);

/**
 * Used to parse radio inputs
 *
 * Needs a seperate parser as each option needs to be treated as a single
 * input (with labels)
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Glynn Quelch <glynn.quelch@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @package PinkCrab\Form_Fields
 */

namespace PinkCrab\Form_Fields\Parsers;

use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Fields\Input_Radio;
use PinkCrab\Form_Fields\Parsers\Field_Parser;

class Radio_Parser extends Field_Parser {

	/**
	 * Field to be rendered.
	 *
	 * @var Input_Radio
	 */
	protected $field;

	public function __construct( Abstract_Field $field ) {
		/* @phpstan-ignore-next-line */
		$this->field = $field;
	}

	/**
	 * Prints the field.
	 *
	 * @return void
	 */
	public function print(): void {
		print join( \PHP_EOL, $this->generate_input_html() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Returns field as a string.
	 *
	 * @return string
	 */
	public function as_string(): string {
		return join( \PHP_EOL, $this->generate_input_html() );

	}

	/**
	 * Geneerates an array of the basic inputs.
	 *
	 * @return array<string, string>
	 */
	protected function generate_input_html(): array {
		$options = $this->field->get_options();
		return array_reduce(
			array_keys( $options ),
			function ( array $carry, string $key ) use ( $options ): array {
				$carry[ $key ] = $this->generate_input( $key, $options[ $key ] );
				return $carry;
			},
			array()
		);
	}

	/**
	 * Generates each input based on label config.
	 *
	 * @param string $key
	 * @param string $name
	 * @return string
	 */
	protected function generate_input( string $key, string $name ): string {

		// Unset value from attributes.
		// This is beacuse we are not using the attribute value or value
		// Due to this being a group not a single item.
		if ( array_key_exists( 'value', $this->field->get_attributes() ) ) {
			$this->field->current();
		}

		switch ( true ) {
			case ! $this->field->label_config()->is_visible():  // No label
				return $this->generate_input_field( $key, $name );
			case $this->field->label_config()->is_wrapped():   // Wrapped In label
				return $this->wrap_input( $key, $name );
			default:                                           // Linked by ID.
				return $this->link_to( $key, $name );
		}
	}

	/**
	 * Creates the input element.
	 *
	 * @param string $key
	 * @param string $value
	 * @return string
	 */
	// phpcs:ignore
	protected function generate_input_field( string $key, string $value ):string {
		return sprintf(
			'<input type="radio"%s name="%s" id="%s" value="%s"%s%s%s>',
			$this->field->render_class(),
			$this->field->get_key(), // name=
			"{$this->field->get_key()}[{$key}]", // id=
			$key, // value=
			$this->field->render_attributes(),
			$this->is_selected( $key ) ? ' CHECKED' : '',
			! empty( $this->field->render_disabled() ) ? ' DISABLED' : ''
		);
	}

	/**
	 * Is the key in the current.
	 *
	 * @param string $key
	 * @return bool
	 */
	public function is_selected( string $key ): bool {
		$selected = is_array( $this->field->get_current() )
			? $this->field->get_current()
			: array( $this->field->get_current() );
		return in_array( $key, $selected, true );
	}

	/**
	 * Renders the form filed wrapped in the label
	 *
	 * @return string
	 */
	protected function wrap_input( string $key, string $name ): string {
		$template     = '<label%1$s for="%2$s">%3$s%4$s</label>';
		$label_config = $this->field->label_config();
		$input_html   = $this->generate_input_field( $key, $name );

		return \sprintf(
			$template,
			$label_config->get_classes() ?? '',
			$key,
			( $label_config->is_positioned_before() ? $name : "\t" . $input_html ) . \PHP_EOL,
			( ! $label_config->is_positioned_before() ? $name : "\t" . $input_html ) . \PHP_EOL,
		);
	}

	/**
	 * Renders the form field with the label linked.
	 *
	 * @return string
	 */
	protected function link_to( string $key, string $name ): string {
		$label_config = $this->field->label_config();
		$template     = $label_config->is_positioned_before()
			? '<label%1$s for="%2$s">%3$s</label>%5$s%4$s'
			: '%3$s%5$s<label%1$s for="%2$s">%4$s</label>';
		$input_html   = $this->generate_input_field( $key, $name );

		return \sprintf(
			$template,
			$label_config->get_classes() ?? '',
			$key,
			$label_config->is_positioned_before() ? $name : $input_html,
			! $label_config->is_positioned_before() ? $name : $input_html,
			\PHP_EOL
		);
	}
}

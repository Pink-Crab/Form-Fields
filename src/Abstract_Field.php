<?php

declare(strict_types=1);

/**
 * A settings field data.
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

namespace PinkCrab\Form_Fields;

use PinkCrab\Form_Fields\Parser;
use PinkCrab\Form_Fields\Label_Config;
use PinkCrab\Form_Fields\Parsers\Field_Parser;

abstract class Abstract_Field {

	/**
	 * Defined the option key.
	 *
	 * @var string
	 */
	protected $key;

	/**
	 * The field name.
	 *
	 * @var string|null
	 */
	protected $name;

	/**
	 * The field type.
	 *
	 * @var string
	 */
	protected $type;

	/**
	 * The fields label.
	 *
	 * @var string
	 */
	protected $label = '';

	/**
	 * Is field disabled
	 *
	 * @var bool
	 */
	protected $disabled = false;

	/**
	 * Field classes.
	 *
	 * @var string
	 */
	protected $class = '';

	/**
	 * Field description.
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * The current value(s)
	 *
	 * @var string|int|float|array<mixed>|null
	 */
	protected $current;

	/**
	 * Holds additonal attributes for the field.
	 *
	 * @var array<string,  mixed>
	 */
	protected $attributes = array();

	/**
	 * Sets if the input is required.
	 *
	 * @var bool
	 */
	protected $required = false;


	/**
	 * Should the field be rendered with the label
	 *
	 * @var Label_Config
	 */
	protected $label_config;

	/**
	 * Parses the field
	 *
	 * @var Parser
	 */
	protected $parser;

	/**
	 * Creates a field with a defined key.
	 *
	 * @param string $key
	 */
	final protected function __construct( string $key ) {
		$this->key          = $key;
		$this->label_config = new Label_Config();
		$this->set_parser();
	}

	/**
	 * Sets the parser (called on construct)
	 *
	 * @return void
	 */
	protected function set_parser(): void {
		$this->parser = new Field_Parser( $this );
	}

	/**
	 * Creates an instance of the field.
	 *
	 * @param string $key
	 * @return static
	 */
	public static function create( string $key ): self {
		$self = get_called_class();
		return new static( $key );
	}

	/**
	 * Generates the inner HTML used to render the inner field
	 * Should not include the wrapping label.
	 *
	 * @return string
	 */
	abstract public function generate_field_html(): string;

	/**
	 * Field used to render the field.
	 *
	 * @return void
	 */
	public function render(): void {
		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		print $this->parser->as_string();
	}

	/**
	 * Returns the field as string.
	 *
	 * @return string
	 */
	public function as_string(): string {
		return $this->parser->as_string();
	}

	/** Setters */

	/**
	 * Sets the name of the field.
	 *
	 * @param string $name
	 * @return self
	 */
	public function name( string $name ): self {
		$this->name = $name;
		return $this;
	}


	/**
	 * Set the current value(s)
	 *
	 * @param string|int|float|array<mixed>|null $current  The current value(s)
	 * @return static
	 */
	public function current( $current = null ) {
		if ( ! empty( $current ) ) {
			$this->attributes['value'] = $current;
		} else {
			$this->unset_attribute( 'value' );
		}
		return $this;
	}

	/**
	 * Set is field disabled
	 *
	 * @param bool $disabled  Is field disabled (true by default.)
	 * @return static
	 */
	public function disabled( bool $disabled = true ): self {
		$this->disabled = $disabled;
		return $this;
	}

	/**
	 * Set is field read only.
	 *
	 * @param bool $read_only  Is field read only (true by default.)
	 * @return static
	 */
	public function read_only( bool $read_only = true ): self {
		if ( $read_only ) {
			$this->attribute( 'readonly', 'readonly' );
		} else {
			$this->unset_attribute( 'readonly' );
		}

		return $this;
	}

	/**
	 * Set the field type.
	 *
	 * @param string $type The field type.
	 * @return static
	 */
	protected function type( string $type ): self {
		$this->type = $type;
		return $this;
	}

	/**
	 * Set the fields label.
	 *
	 * @param string $label  The fields label.
	 * @return static
	 */
	public function label( string $label ): self {
		$this->label = $label;
		return $this;
	}

	/**
	 * Set field classes.
	 *
	 * @param string $class  Field classes.
	 * @return static
	 */
	public function class( string $class ): self {
		$this->class = $class;
		return $this;
	}

	/**
	 * Set field description.
	 *
	 * @param string $description  Field description.
	 * @return static
	 */
	public function description( string $description ): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * Sets a single attribute.
	 *
	 * @param string $key
	 * @param string $value
	 * @return static
	 */
	public function attribute( string $key, string $value ): self {
		$this->attributes[ $key ] = $value;
		return $this;
	}

	/**
	 * Set Attributes as an array.
	 *
	 * @param array<string, string> $attributes
	 *
	 * @return static
	 */
	public function set_attributes( array $attributes ): self {
		$this->attributes = $attributes;
		return $this;
	}

	/**
	 * Sets the visibility of the label
	 *
	 * @param bool $show
	 * @return static
	 */
	public function show_label( bool $show = true ): self {
		$this->label_config->visibility( $show );
		return $this;
	}

	/**
	 * Replaces the label config with a new instance.
	 *
	 * @param int $mode Bitwise values for positioning.
	 * @return static
	 */
	public function label_position( int $mode = 0 ): self {
		$this->label_config->set_position( $mode );
		return $this;
	}

	/** GETTERs */

	/**
	 * Get the field type.
	 *
	 * @return string
	 */
	public function get_type(): string {
		return $this->type;
	}

	/**
	 * Get the fields label.
	 *
	 * @return string
	 */
	public function get_label(): string {
		return $this->label;
	}


	/**
	 * Get field classes.
	 *
	 * @return string
	 */
	public function get_class(): string {
		return $this->class;
	}

	/**
	 * Get is field disabled
	 *
	 * @return bool
	 */
	public function get_disabled(): bool {
		return $this->disabled;
	}

	/**
	 * Get field description.
	 *
	 * @return string
	 */
	public function get_description(): string {
		return $this->description;
	}

	/**
	 * Get defined the option key.
	 *
	 * @return string
	 */
	public function get_key(): string {
		return $this->key;
	}


	/**
	 * Get the field name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return $this->name ?? $this->key;
	}

	/**
	 * Get the current value(s)
	 *
	 * @return string|int|float|array<mixed>|null
	 */
	public function get_current() {
		return array_key_exists( 'value', $this->attributes )
			? $this->attributes['value']
			: null;
	}

	/**
	 * Get attributes
	 *
	 * @return array<string, string>
	 */
	public function get_attributes(): array {
		return $this->attributes;
	}

	/**
	 * Returns access to the label config.
	 *
	 * @return Label_Config
	 */
	public function label_config(): Label_Config {
		return $this->label_config;
	}

	/**
	 * Unsets an attribute if its been set.
	 *
	 * @param string $key
	 * @return void
	 */
	protected function unset_attribute( string $key ): void {
		if ( array_key_exists( $key, $this->attributes ) ) {
			unset( $this->attributes[ $key ] );
		}
	}

	/** RENDER HELPERS. */

	/**
	 * Renders if disabled.
	 *
	 * @return string
	 */
	public function render_disabled(): string {
		return $this->get_disabled() ? 'DISABLED ' : '';
	}

	/**
	 * Renders the class if its set.
	 *
	 * @return string
	 */
	public function render_class(): string {
		return ! empty( $this->get_class() )
			? "class=\"{$this->get_class()}\" "
			: '';
	}

	/**
	 * Renders the attributes defined.
	 *
	 * @return string
	 */
	public function render_attributes(): string {
		return \array_reduce(
			\array_keys( $this->attributes ),
			function( string $output, string $attribute_key ): string {

				// If we have an array, skip
				if ( is_array( $this->attributes[ $attribute_key ] ) ) {
					return $output;
				}

				return $output .= \sprintf(
					' %s="%s"',
					function_exists( 'esc_attr' )
						? esc_attr( $attribute_key )
						: $attribute_key,
					function_exists( 'esc_attr' )
						? esc_attr( $this->attributes[ $attribute_key ] )
						: $this->attributes[ $attribute_key ]
				);
			},
			''
		);
	}

}

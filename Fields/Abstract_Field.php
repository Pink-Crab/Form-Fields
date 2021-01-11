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
 * @package PinkCrab\ExtLibs\Admin_Pages
 */

namespace PinkCrab\Modules\Form_Fields\Fields;

use PinkCrab\Modules\Form_Fields\Label_Config;
use PinkCrab\Modules\Form_Fields\Fields\Input_Text;

abstract class Abstract_Field {

	/**
	 * All field type constants.
	 */
	public const TEXT     = Input_Text::class;
	public const TEXTAREA = Input_Text::class;
	public const CHECKBOX = 'text';
	public const COLOUR   = 'text';
	public const SELECT   = 'text';
	public const RADIO    = 'text';


	/**
	 * Defined the option key.
	 *
	 * @var string
	 */
	protected $key;

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
	protected $label;

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
	 * Placeholder if input supports.
	 * If select, will be set as first option with no value.
	 *
	 * @var string
	 */
	protected $placeholder = '';

	/**
	 * Field descriptiion.
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Holds the fields options.
	 * [ ['key1'=>'value1'], ['key2'=>'value2'] ]
	 *
	 * @var array<string, string>
	 */
	protected $options;

	/**
	 * Initial values.
	 * Based on input type can be any type.
	 *
	 * @var string|int|float|array
	 */
	protected $default;

	/**
	 * The current value(s)
	 *
	 * @var string|int|float|array
	 */
	protected $current;

	/**
	 * Holds additonal attributes for the field.
	 *
	 * @var array<string,  string>
	 */
	protected $attributes = array();

	/**
	 * Should the field be rendered with the label
	 *
	 * @var Label_Config|null
	 */
	protected $label_config;

	/**
	 * Creates a field with a defined key.
	 *
	 * @param string $key
	 */
	protected function __construct( string $key ) {
		$this->key          = $key;
		$this->label_config = new Label_Config;
	}

	/**
	 * Field used to render the field.
	 *
	 * @return void
	 */
	abstract public function render(): void;

	/** Setters */


	/**
	 * Set the current value(s)
	 *
	 * @param string|int|float|array $current  The current value(s)
	 * @return self
	 */
	public function current( $current ): self {
		$this->current = $current;
		return $this;
	}

	/**
	 * Set is field disabled
	 *
	 * @param bool $disabled  Is field disabled (true by default.)
	 * @return self
	 */
	public function disabled( bool $disabled = true ): self {
		$this->disabled = $disabled;
		return $this;
	}

	/**
	 * Set the field type.
	 *
	 * @param string $type  The field type.
	 * @return self
	 */
	public function type( string $type ): self {
		$this->type = $type;
		return $this;
	}

	/**
	 * Set based on input type can be any type.
	 *
	 * @param string|int|float|array $default  Based on input type can be any type.
	 * @return self
	 */
	public function default( $default ): self {
		$this->default = $default;
		return $this;
	}

	/**
	 * Set the fields label.
	 *
	 * @param string $label  The fields label.
	 * @return self
	 */
	public function label( string $label ): self {
		$this->label = $label;
		return $this;
	}

	/**
	 * Set field classes.
	 *
	 * @param string $class  Field classes.
	 * @return self
	 */
	public function class( string $class ): self {
		$this->class = $class;
		return $this;
	}

	/**
	 * Set if select, will be set as first option with no value.
	 *
	 * @param string $placeholder  If select, will be set as first option with no value.
	 * @return self
	 */
	public function placeholder( string $placeholder ): self {
		$this->placeholder = $placeholder;
		return $this;
	}

	/**
	 * Set the options.
	 *
	 * @param $options array<string, string>
	 * @return self
	 */
	public function options( array $options ): self {
		$this->options = $options;
		return $this;
	}

	/**
	 * Set field descriptiion.
	 *
	 * @param string $description  Field descriptiion.
	 * @return self
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
	 * @return self
	 */
	public function attribute( string $key, string $value ): self {
		$this->attributes[ $key ] = $value;
		return $this;
	}

	/**
	 * Set Attributes as an array.
	 *
	 * @param $attributes array<string, string>
	 *
	 * @return self
	 */
	public function set_attributes( array $attributes ): self {
		$this->attributes = $attributes;
		return $this;
	}

	/**
	 * Sets the visibility of the label
	 *
	 * @param bool $show
	 * @return self
	 */
	public function show_label( bool $show = true ): self {
		$this->label_config->visibility( $show );
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
	 * Get if select, will be set as first option with no value.
	 *
	 * @return string
	 */
	public function get_placeholder(): string {
		return $this->placeholder;
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
	 * Get Options
	 *
	 * @return array<string, string>
	 */
	public function get_options(): array {
		return $this->options;
	}


	/**
	 * Get based on input type can be any type.
	 *
	 * @return string|int|float|array
	 */
	public function get_default() {
		return $this->default;
	}


	/**
	 * Get field descriptiion.
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
	 * Get the current value(s)
	 *
	 * @return string|int|float|array
	 */
	public function get_current() {
		return $this->current;
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


	/** RENDER HELPERS. */

	/**
	 * Renders if disabled.
	 *
	 * @return string
	 */
	protected function render_disabled(): string {
		return $this->get_disabled() ? 'DISABLED' : '';
	}

	/**
	 * Renders if the description set.
	 *
	 * @return string
	 */
	protected function render_description(): string {
		return ! empty( $this->get_description() )
			? sprintf( '<p class="description">%s</p>', \wp_kses_post( $this->get_description() ) )
			: '';
	}

	/**
	 * Renders the attributes defined.
	 *
	 * @return string
	 */
	protected function render_attributes(): string {
		return \array_reduce(
			\array_keys( $this->attributes ),
			function( string $output, string $attribute_key ): string {
				return $output .= \sprintf(
					' %s="%s"',
					esc_attr( $attribute_key ),
					esc_attr( $this->attributes[ $attribute_key ] )
				);
			},
			''
		);
	}

	public function render_screenreader_legend(): string {
		return 'SCREEN READER LEGEND';
	}

	/**
	 * Generates the inner HTML used to render the inner field
	 * Should not include the wrapping label.
	 *
	 * @return string
	 */
	abstract public function generate_field_html(): string;



}

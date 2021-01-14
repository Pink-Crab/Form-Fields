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

namespace PinkCrab\Form_Fields\Fields;

use stdClass;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Traits\Options;
use PinkCrab\Form_Fields\Traits\Multiple;
use PinkCrab\Form_Fields\Traits\Placeholder;
use PinkCrab\Form_Fields\Traits\Autocomplete;

class Select extends Abstract_Field {

	use Multiple, Options, Placeholder, Autocomplete;

	/**
	 * The field type.
	 *
	 * @var string
	 */
	protected $type = 'select';

	/**
	 * Set the current value(s)
	 *
	 * @param string|int|float|array<mixed> $current  The current value(s)
	 * @return static
	 */
	// public function current( $current = null ) {
	// 	if ( ! empty( $current ) ) {
	// 		$this->current = is_array( $current ) ? $current : array( $current );
	// 	} else {
	// 		$this->current = array();
	// 	}
	// 	return $this;
	// }

	/**
	 * Generates an array of the options from the detined values.
	 *
	 * @return string
	 */
	protected function generate_options(): string {
		$options = array();
		if ( ! empty( $this->get_placeholder() ) ) {
			$options[] = $this->option_factory( '', $this->get_placeholder() );
		}

		// Add items
		$options = array_merge( $options, $this->option_builder( $this->options ) );
		return join(
			PHP_EOL,
			array_map(
				function( stdClass $option ) {
					return $option->is_group
					? $this->generate_option_group_html( $option )
					: $this->generate_option_html( (string) $option->key, $option->value );
				},
				$options
			)
		);
	}

	/**
	 * Builds the options array based on type.
	 *
	 * @param array<string, mixed> $options
	 * @return array<int, object>
	 */
	protected function option_builder( array $options ): array {
		return array_reduce(
			array_keys( $options ),
			function( $compiled, $option_key ) use ( $options ) {
				$compiled[] = $this->option_factory(
					$option_key,
					$options[ $option_key ],
					is_array( $options[ $option_key ] )
				);
				return $compiled;
			},
			array()
		);
	}

	/**
	 * Generates an object used for the rendered options.
	 *
	 * @param string $key
	 * @param string|int|float|array<mixed> $value
	 * @param bool $is_group
	 * @return object
	 */
	protected function option_factory(
		string $key,
		$value,
		bool $is_group = false
	): object {
		return (object) array(
			'key'      => $key,
			'value'    => $value,
			'is_group' => $is_group,
		);
	}

	/**
	 * Generates the HTML for a single select item.
	 *
	 * @param string $key
	 * @param string $value
	 * @return string
	 */
	public function generate_option_html( string $key, string $value ): string {
		$current = is_array( $this->get_current() )
			? $this->get_current()
			: array( $this->get_current() );

		return \sprintf(
			"\t<option value=\"%s\"%s>%s</option>",
			$key,
			in_array( $key, $current, true ) ? ' SELECTED="selected"' : '',
			(string) $value
		);
	}

	/**
	 * Generates an option group.
	 *
	 * @param stdClass $option
	 * @return string
	 */
	public function generate_option_group_html( stdClass $option ): string {
		$groups_options = $option->value;
		return \sprintf(
			"<optgroup label=\"%s\">\n%s\n</optgroup>",
			$option->key,
			join(
				PHP_EOL,
				array_map(
					function( $key ) use ( $groups_options ) {
						return $this->generate_option_html( (string) $key, $groups_options[ $key ] );
					},
					array_keys( $groups_options )
				)
			)
		);
	}



	/**
	 * Returns the select HTML
	 *
	 * @return string
	 */
	public function generate_field_html(): string {
		return <<<HTML
<select {$this->render_class()}name="{$this->get_key()}" id="{$this->get_key()}"{$this->render_attributes()} {$this->render_disabled()}{$this->render_multiple()}> 
{$this->generate_options()}
</select>
HTML;
	}
}



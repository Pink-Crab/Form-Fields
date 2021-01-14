<?php

declare(strict_types=1);

/**
 * Range input field.
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

use PinkCrab\Form_Fields\Traits\Options;
use PinkCrab\Form_Fields\Fields\Input_Number;

class Input_Range extends Input_Number {

	use Options;

	/**
	 * The field type.
	 *
	 * @var string
	 */
	protected $type = 'input';

	/**
	 * Sets the input type
	 *
	 * @var string
	 */
	protected $input_type = 'range';

		/**
	 * Returns the input HTML
	 *
	 * @return string
	 */
	public function generate_field_html(): string {
		$this->maybe_include_list_attribute();
		return parent::generate_field_html() . $this->generate_hash_marks();
	}

	/**
	 * Maybe add the list attribute if has hash.
	 *
	 * @return void
	 */
	protected function maybe_include_list_attribute() {
		if ( ! empty( $this->options ) ) {
			$this->attribute( 'list', $this->hash_list_key() );
		}
	}

	/**
	 * Generates the hash list ID.
	 *
	 * @return string
	 */
	protected function hash_list_key(): string {
		return $this->get_key() . '_hash_marks';
	}

	/**
	 * Generates a hash mark list if options set.
	 *
	 * @return string
	 */
	protected function generate_hash_marks(): string {
		if ( empty( $this->options ) ) {
			return '';
		}
		return sprintf(
			"\n<datalist id=\"%s\">%s\n</datalist>",
			$this->hash_list_key(),
			join(
				array_map(
					function( $key ) {
						return ! empty( $this->options[ $key ] )
							? sprintf( "\n\t<option value=\"%s\" label=\"%s\"></option>", $key, $this->options[ $key ] )
							: sprintf( "\n\t<option value=\"%s\"></option>", $key );
					},
					array_keys( $this->options )
				)
			)
		);
	}
}

<?php

declare(strict_types=1);

/**
 * Datalist property.
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

namespace PinkCrab\Form_Fields\Traits;

use PinkCrab\Form_Fields\Traits\Options;

trait Datalist {

	use Options;

	/**
	 * The format for the datalist key.
	 *
	 * @var string|null
	 */
	protected $datalist_key;

	/**
	 * Gets the defined datalist key.
	 *
	 * @return string
	 */
	protected function get_datalist_key(): string {
		$template = $this->datalist_key ?? '_{key}__list';

		// Replace placeholders.
		return \str_replace(
			array( '{key}', '{name}', '{hash}' ),
			array( $this->get_key(), $this->get_name(), md5( \json_encode( $this ) ?: get_class() ) ), //phpcs:ignore
			$template
		);
	}

	/**
	 * Sets the datalist key
	 *
	 * @param string $key
	 * @return self
	 */
	public function datalist_key( string $key ): self {
		$this->datalist_key = $key;
		return $this;
	}

	/**
	 * Renders the datalist if options are set.
	 *
	 * @return string
	 */
	public function maybe_render_datalist(): string {
		// Bail if no defined options.
		if ( empty( $this->options ) ) {
			return '';
		}

		// Set the list attribute.
		$this->attribute( 'list', $this->get_datalist_key() );

		return $this->generate_datalist();
	}

	/**
	 * Adds a single options
	 *
	 * @param string $value
	 * @param string|null $label An option label to be used
	 * @return static
	 */
	public function option( string $value, ?string $label = null ) {
		$this->options[ $value ] = $label ?? '';
		return $this;
	}

	/**
	 * Generates the datalist HTML as a string
	 *
	 * @return string
	 */
	protected function generate_datalist(): string {
		return sprintf(
			"<datalist id=\"%s\">%s\n</datalist>\n",
			$this->get_datalist_key(),
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

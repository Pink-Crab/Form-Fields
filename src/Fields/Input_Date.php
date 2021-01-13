<?php

declare(strict_types=1);

/**
 * Date input field
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

use PinkCrab\Form_Fields\Traits\Range;
use PinkCrab\Form_Fields\Fields\Input_Text;

class Input_Date extends Input_Text {

	use Range;

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
	protected $input_type = 'date';

	/**
	 * Pattern for mapping values.
	 *
	 * @var string|null
	 */
	protected $pattern;

	/**
	 * Get pattern for mapping values.
	 *
	 * @return string|null
	 */
	public function get_pattern(): ?string {
		return $this->pattern;
	}

	/**
	 * Set pattern for mapping values.
	 *
	 * @param string $pattern  Pattern for mapping values.
	 * @return self
	 */
	public function pattern( string $pattern ): self {
		$this->pattern = $pattern;
		return $this;
	}

	/**
	 * Renders the text input.
	 *
	 * @return void
	 */
	public function render(): void {
		$this->_populate_attributes();
		parent::render();
	}

	/**
	 * Returns the input HTML
	 *
	 * @return string
	 */
	public function generate_field_html(): string {
		$this->_populate_attributes();
		return parent::generate_field_html();
	}

	/**
	 * If the mix/max/step/pattern values are set, add to attributes.
	 * Run before generating the HTML
	 *
	 * @return void
	 */
	protected function _populate_attributes() {
		if ( ! is_null( $this->get_min() ) ) {
			$this->attribute( 'min', (string) $this->get_min() );
		}
		if ( ! is_null( $this->get_max() ) ) {
			$this->attribute( 'max', (string) $this->get_max() );
		}
		if ( ! is_null( $this->get_step() ) ) {
			$this->attribute( 'step', (string) $this->get_step() );
		}
		if ( ! is_null( $this->get_pattern() ) ) {
			$this->attribute( 'pattern', (string) $this->get_pattern() );
		}
	}



}

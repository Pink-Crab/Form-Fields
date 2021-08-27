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

use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Traits\Pattern;
use PinkCrab\Form_Fields\Traits\Placeholder;
use PinkCrab\Form_Fields\Traits\Autocomplete;

class Textarea extends Abstract_Field {

	use Placeholder, Autocomplete;

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
	protected $input_type = 'text';

	/**
	 * Denotes the number of rows in the text area.
	 *
	 * @var int|null
	 */
	protected $rows;

	/**
	 * Denotes the number of columns in the text area.
	 *
	 * @var int|null
	 */
	protected $columns;

	/**
	 * Temp holder of a defined value.
	 *
	 * @var string|null
	 */
	protected $current_value;

	/**
	 * Get the columns value
	 *
	 * @return mixed
	 */
	public function get_columns() {
		return $this->columns;
	}

	/**
	 * Set the columns value
	 *
	 * @param int|null $columns  The columns value
	 * @return self
	 */
	public function columns( ?int $columns = null ): self {
		$this->columns = $columns;
		return $this;
	}

	/**
	 * Get the rows value
	 *
	 * @return mixed
	 */
	public function get_rows() {
		return $this->rows;
	}

	/**
	 * Set the rows value
	 *
	 * @param int|null $rows  The rows value
	 * @return self
	 */
	public function rows( ?int $rows = null ): self {
		$this->rows = $rows;
		return $this;
	}

	/**
	 * Renders the current value if set.
	 *
	 * @return string
	 */
	protected function render_current_value(): string {
		return $this->current_value ?? '';
	}

	/**
	 * Renders the text input.
	 *
	 * @return void
	 */
	public function render(): void {
		$this->populate_attributes();
		parent::render();
	}


	/**
	 * Returns the input HTML
	 *
	 * @return string
	 */
	public function generate_field_html(): string {
		$this->populate_attributes();
		return <<<HTML
<textarea {$this->render_class()}name="{$this->get_name()}" id="{$this->get_key()}"{$this->render_attributes()} {$this->render_disabled()} />
{$this->render_current_value()}
</textarea>
HTML;
	}


	/**
	 * If the mix/max/step/pattern values are set, add to attributes.
	 * Run before generating the HTML
	 *
	 * @return void
	 */
	protected function populate_attributes() {
		if ( ! is_null( $this->get_columns() ) ) {
			$this->attribute( 'cols', (string) $this->get_columns() );
		}
		if ( ! is_null( $this->get_rows() ) ) {
			$this->attribute( 'rows', (string) $this->get_rows() );
		}
		if ( array_key_exists( 'value', $this->get_attributes() ) ) {
			$this->current_value = $this->attributes['value'];
			unset( $this->attributes['value'] );
		}
	}

}



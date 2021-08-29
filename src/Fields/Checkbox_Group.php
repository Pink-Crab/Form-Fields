<?php

declare(strict_types=1);

/**
 * A group of checkboxes
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

use PinkCrab\Form_Fields\Label_Config;
use PinkCrab\Form_Fields\Abstract_Field;
use PinkCrab\Form_Fields\Traits\Options;

class Checkbox_Group extends Abstract_Field {

	use Options;

	/**
	 * The field type.
	 *
	 * @var string
	 */
	protected $type = 'checkebox_group';

	/**
	 * The checked value for each checkbox.
	 *
	 * @var string
	 */
	protected $checked_value = 'on';

	/**
	 * Set the current value(s)
	 *
	 * @param string|int|float|array<mixed> $current  The current value(s)
	 * @return static
	 */
	public function current( $current = null ) {
		if ( ! empty( $current ) ) {
			$this->current = is_array( $current ) ? $current : array( $current );
		} else {
			$this->current = array();
		}

		return $this;
	}


	/**
	 * Set the checked value for each checkbox.
	 *
	 * @param string $checked_value  The checked value for each checkbox.
	 * @return self
	 */
	public function checked_value( string $checked_value ): self {
		$this->checked_value = $checked_value;
		return $this;
	}

	/**
	 * Returns the select HTML
	 *
	 * @return string
	 */
	public function generate_field_html(): string {

		// Compose assets.
		$inputs     = $this->generate_checkboxes();
		$id         = $this->get_key();
		$name       = $this->get_name();
		$attributes = $this->render_attributes();
		$classes    = $this->render_class();
		$disabled   = $this->render_disabled();

		return <<<HTML
		<fieldset name="$name" id="$id" $classes $attributes $disabled>
			$inputs
		</fieldset>
HTML;
	}

	/**
	 * Renders all checkboxes as a string representation.
	 *
	 * @return string
	 */
	protected function generate_checkboxes(): string {
		$content = '';

		// Loops thorough each item and creates the checkboxes.
		foreach ( $this->get_options() as $key => $option ) {
			// Create the input and concatenate to return string.
			$content .= Input_Checkbox::create( "{$this->get_key()}[{$key}]" )
				->checked( is_array( $this->current ) && in_array( $key, $this->current, true ) )
				->current( $this->checked_value )
				->show_label()
				->label( $option )
				->label_position( Label_Config::AFTER_INPUT )
				->as_string();
		}

		return $content;
	}

}

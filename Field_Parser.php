<?php

declare(strict_types=1);

/**
 * Parses a field.
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

namespace PinkCrab\Modules\Form_Fields;

use PinkCrab\Modules\Form_Fields\Fields\Abstract_Field;

class Field_Parser {

	/**
	 * Field to be rendered.
	 *
	 * @var Abstract_Field
	 */
	protected $field;

	public function __construct( Abstract_Field $field ) {
		$this->field = $field;
	}

	/**
	 * Prints the field.
	 *
	 * @return void
	 */
	public function print(): void {
		# code...
	}

	/**
	 * Returns field as a string.
	 *
	 * @return string
	 */
	public function as_string(): string {
		return $this->wrapped_in_label();
	}

	protected function wrapped_in_label(): string {
		$template     = '<label %1$s for="%2$s">
%3$s
%4$s
</label>';
		$label_config = $this->field->label_config();
		return \sprintf(
			$template,
			$label_config->get_classes() ?? '',
			$this->field->get_key(),
			$label_config->is_positioned_above() ? $this->field->get_label() : $this->field->generate_field_html(),
			! $label_config->is_positioned_above() ? $this->field->get_label() : $this->field->generate_field_html(),
		);
	}

	protected function linked_to_label(): string {
		# code...
	}
}
// public

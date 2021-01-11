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

use PinkCrab\Modules\Form_Fields\Fields\Abstract_Field;

class Input_Text extends Abstract_Field {

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
	 * Denotes if the field has auto complete.
	 *
	 * @var bool
	 */
	protected $autocomplete = false;

	/**
	 * Creates an instance of the field.
	 *
	 * @param string $key
	 * @param string $title
	 * @return self
	 */
	public static function create( string $key, string $title ): self {
		$field = new static( $key );
		return $field->label( $title );
	}

	/**
	 * Returns the input HTML
	 *
	 * @return string
	 */
	public function generate_field_html(): string {
		return <<<HTML
	<input 
		class="input-text regular-text {$this->get_class()}" 
		type="{$this->input_type}" 
		name="{$this->get_key()}" 
		id="{$this->get_key()}" 
		value="{$this->get_current()}" 
		placeholder="{$this->get_placeholder()}" 
		{$this->render_disabled()}
		{$this->render_attributes()}
	/>
HTML;
	}

	/**
	 * Renders the text input.
	 *
	 * @return void
	 */
	public function render(): void {
		echo <<<HTML
<fieldset>
	<input 
		class="input-text regular-text {$this->get_class()}" 
		type="{$this->input_type}" 
		name="{$this->get_key()}" 
		id="{$this->get_key()}" 
		value="{$this->get_current()}" 
		placeholder="{$this->get_placeholder()}" 
		{$this->render_disabled()}
		{$this->render_attributes()}
	/>
	{$this->render_description()}
</fieldset>
HTML;
	}
}



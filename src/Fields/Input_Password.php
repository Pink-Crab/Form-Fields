<?php

declare(strict_types=1);

/**
 * Password field.
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

use PinkCrab\Form_Fields\Traits\Length;
use PinkCrab\Form_Fields\Traits\Pattern;
use PinkCrab\Form_Fields\Traits\Placeholder;
use PinkCrab\Form_Fields\Traits\Autocomplete;
use PinkCrab\Form_Fields\Fields\Abstract_Input;

class Input_Password extends Abstract_Input {

	// Input attributes.
	use Placeholder, Autocomplete, Pattern, Length;

	/**
	 * Sets the input type
	 *
	 * @var string
	 */
	protected $input_type = 'password';

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
		return parent::generate_field_html();
	}

	/**
	 * If the mix/ax/step values are set, add to attributes.
	 * Run before generating the HTML
	 *
	 * @return void
	 */
	protected function populate_attributes() {
		if ( ! is_null( $this->minlength ) ) {
			$this->attribute( 'minlength', (string) $this->get_minlength() );
		}
		if ( ! is_null( $this->maxlength ) ) {
			$this->attribute( 'maxlength', (string) $this->get_maxlength() );
		}
	}
}



<?php

declare(strict_types=1);

/**
 * Radio group of input
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
use PinkCrab\Form_Fields\Parsers\Radio_Parser;
use PinkCrab\Form_Fields\Fields\Abstract_Input;

class Input_Radio extends Abstract_Input {

	/**
	 * Use the checked property.
	 */
	use Options;

	/**
	 * Sets the input type
	 *
	 * @var string
	 */
	protected $input_type = 'radio';


	/**
	 * Sets the parser (called on construct)
	 *
	 * @return void
	 */
	protected function set_parser(): void {
		$this->parser = new Radio_Parser( $this );
	}

	/**
	 * @inheritdoc
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
	 * @inheritdoc
	 */
	public function get_current() {
		return is_array( $this->current )
			? $this->current
			: array( $this->current );
	}

	/**
	 * Returns the input HTML
	 *
	 * @noOp
	 * @return string
	 */
	public function generate_field_html(): string {
		return ''; // NoOp
	}
}



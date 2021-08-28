<?php

declare(strict_types=1);

/**
 * File field.
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

use PinkCrab\Form_Fields\Traits\Multiple;
use PinkCrab\Form_Fields\Fields\Abstract_Input;

class Input_File extends Abstract_Input {

	use Multiple;

	/**
	 * Sets the input type
	 *
	 * @var string
	 */
	protected $input_type = 'file';

	/**
	 * Get the accept value
	 *
	 * @return mixed
	 */
	public function get_accept() {
		return array_key_exists( 'accept', $this->attributes )
			? (string) $this->attributes['accept']
			: '';
	}

	/**
	 * Set the accept value
	 *
	 * @param string $accept  The accept value
	 * @return self
	 */
	public function accept( string $accept = '' ): self {
		if ( \mb_strlen( (string) $accept ) !== 0 ) {
			$this->attribute( 'accept', (string) $accept );
		} else {
			$this->unset_attribute( 'accept' );
		}

		return $this;
	}

	/**
	 * Get the capture value
	 *
	 * @return mixed
	 */
	public function get_capture() {
		return array_key_exists( 'capture', $this->attributes )
			? (string) $this->attributes['capture']
			: '';
	}

	/**
	 * Set the capture value
	 *
	 * @param string $capture  The capture value
	 * @return self
	 */
	public function capture( string $capture = '' ): self {
		if ( \mb_strlen( (string) $capture ) !== 0 ) {
			$this->attribute( 'capture', (string) $capture );
		} else {
			$this->unset_attribute( 'capture' );
		}

		return $this;
	}
}

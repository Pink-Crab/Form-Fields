<?php

declare(strict_types=1);

/**
 * Image field.
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

use PinkCrab\Form_Fields\Fields\Abstract_Input;

class Input_Image extends Abstract_Input {

	/**
	 * Sets the input type
	 *
	 * @var string
	 */
	protected $input_type = 'image';

	/**
	 * Get the src value
	 *
	 * @return mixed
	 */
	public function get_src() {
		return array_key_exists( 'src', $this->attributes )
			? (string) $this->attributes['src']
			: '';
	}

	/**
	 * Set the src value
	 *
	 * @param string $src  The src value
	 * @return self
	 */
	public function src( string $src = '' ): self {
		if ( \mb_strlen( (string) $src ) !== 0 ) {
			$this->attribute( 'src', (string) $src );
		} else {
			$this->unset_attribute( 'src' );
		}

		return $this;
	}

	/**
	 * Get the height value
	 *
	 * @return mixed
	 */
	public function get_height() {
		return array_key_exists( 'height', $this->attributes )
			? (string) $this->attributes['height']
			: '';
	}

	/**
	 * Set the height value
	 *
	 * @param string $height  The height value
	 * @return self
	 */
	public function height( string $height = '' ): self {
		if ( \mb_strlen( (string) $height ) !== 0 ) {
			$this->attribute( 'height', (string) $height );
		} else {
			$this->unset_attribute( 'height' );
		}

		return $this;
	}

	/**
	 * Get the alt value
	 *
	 * @return mixed
	 */
	public function get_alt() {
		return array_key_exists( 'alt', $this->attributes )
			? (string) $this->attributes['alt']
			: '';
	}

	/**
	 * Set the alt value
	 *
	 * @param string $alt  The alt value
	 * @return self
	 */
	public function alt( string $alt = '' ): self {
		if ( \mb_strlen( (string) $alt ) !== 0 ) {
			$this->attribute( 'alt', (string) $alt );
		} else {
			$this->unset_attribute( 'alt' );
		}

		return $this;
	}

	/**
	 * Get the width value
	 *
	 * @return mixed
	 */
	public function get_width() {
		return array_key_exists( 'width', $this->attributes )
			? (string) $this->attributes['width']
			: '';
	}

	/**
	 * Set the width value
	 *
	 * @param string $width  The width value
	 * @return self
	 */
	public function width( string $width = '' ): self {
		if ( \mb_strlen( (string) $width ) !== 0 ) {
			$this->attribute( 'width', (string) $width );
		} else {
			$this->unset_attribute( 'width' );
		}

		return $this;
	}

}

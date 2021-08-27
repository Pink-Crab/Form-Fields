<?php

declare(strict_types=1);

/**
 * Length property.
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

trait Length {


	/**
	 * Get the minlength value
	 *
	 * @return mixed
	 */
	public function get_minlength() {
		return array_key_exists( 'minlength', $this->attributes )
			? (string) $this->attributes['minlength']
			: '';
	}

	/**
	 * Set the minlength value
	 *
	 * @param int|string|float $minlength  The minlength value
	 * @return self
	 */
	public function minlength( $minlength ): self {
		if ( \mb_strlen( (string) $minlength ) !== 0 ) {
			$this->attribute( 'minlength', (string) $minlength );
		} else {
			$this->unset_attribute( 'minlength' );
		}

		return $this;
	}

	/**
	 * Get the maxlength value
	 *
	 * @return mixed
	 */
	public function get_maxlength() {
		return array_key_exists( 'maxlength', $this->attributes )
			? (string) $this->attributes['maxlength']
			: '';
	}

	/**
	 * Set the maxlength value
	 *
	 * @param int|string|float $maxlength  The maxlength value
	 * @return self
	 */
	public function maxlength( $maxlength ): self {
		if ( \mb_strlen( (string) $maxlength ) !== 0 ) {
			$this->attribute( 'maxlength', (string) $maxlength );
		} else {
			$this->unset_attribute( 'maxlength' );
		}

		return $this;
	}

}

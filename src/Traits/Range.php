<?php

declare(strict_types=1);

/**
 * Range field trait, adds min, max and step
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

trait Range {

	/**
	 * Set min value.
	 *
	 * @param mixed $min
	 * @return self
	 */
	public function min( $min ): self {
		if ( \mb_strlen( (string) $min ) !== 0 ) {
			$this->attribute( 'min', (string) $min );
		} else {
			$this->unset_attribute( 'min' );
		}

		return $this;
	}

	/**
	 * Get min value.
	 *
	 * @return string
	 */
	public function get_min(): string {
		return array_key_exists( 'min', $this->attributes )
			? (string) $this->attributes['min']
			: '';
	}

	/**
	 * Set max value.
	 *
	 * @param mixed $max
	 * @return self
	 */
	public function max( $max ): self {
		if ( \mb_strlen( (string) $max ) !== 0 ) {
			$this->attribute( 'max', (string) $max );
		} else {
			$this->unset_attribute( 'max' );
		}

		return $this;
	}

	/**
	 * Get max value.
	 *
	 * @return string
	 */
	public function get_max(): string {
		return array_key_exists( 'max', $this->attributes )
			? (string) $this->attributes['max']
			: '';
	}

	/**
	 * Set step value.
	 *
	 * @param mixed $step
	 * @return self
	 */
	public function step( $step ): self {
		if ( \mb_strlen( (string) $step ) !== 0 ) {
			$this->attribute( 'step', (string) $step );
		} else {
			$this->unset_attribute( 'step' );
		}

		return $this;
	}

	/**
	 * Get step value.
	 *
	 * @return string
	 */
	public function get_step(): string {
		return array_key_exists( 'step', $this->attributes )
			? (string) $this->attributes['step']
			: '';
	}
}

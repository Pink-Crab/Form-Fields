<?php

declare(strict_types=1);

/**
 * Adds Pattern Attribute functionality
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

trait Pattern {

	/**
	 * Set pattern value.
	 *
	 * @param string $pattern
	 * @return self
	 */
	public function pattern( string $pattern = '' ): self {
		if ( \mb_strlen( $pattern ) !== 0 ) {
			$this->attribute( 'pattern', $pattern );
		} else {
			$this->unset_attribute( 'pattern' );
		}

		return $this;
	}

	/**
	 * Get pattern value.
	 *
	 * @return string|null
	 */
	public function get_pattern(): ?string {
		return array_key_exists( 'pattern', $this->attributes )
			? (string) $this->attributes['pattern']
			: null;
	}

}

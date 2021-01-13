<?php

declare(strict_types=1);

/**
 * Adds Placeholder functionality
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

trait Placeholder {

	/**
	 * Set if select, will be set as first option with no value.
	 *
	 * @param string $placeholder  If select, will be set as first option with no value.
	 * @return self
	 */
	public function placeholder( string $placeholder = '' ): self {
		if ( ! empty( $placeholder ) ) {
			$this->attribute( 'placeholder', $placeholder );
		} else {
			$this->unset_attribute( 'placeholder' );
		}

		return $this;
	}

	/**
	 * Get if select, will be set as first option with no value.
	 *
	 * @return string
	 */
	public function get_placeholder(): string {
		return array_key_exists( 'placeholder', $this->attributes )
			? $this->attributes['placeholder']
			: '';
	}

}

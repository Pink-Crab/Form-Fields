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
	 * Min length.
	 *
	 * @var int|null
	 */
	protected $minlength;

	/**
	 * Max length.
	 *
	 * @var int|null
	 */
	protected $maxlength;

	/**
	 * Get the minlength value
	 *
	 * @return mixed
	 */
	public function get_minlength() {
		return $this->minlength;
	}

	/**
	 * Set the minlength value
	 *
	 * @param int|string|float $minlength  The minlength value
	 * @return self
	 */
	public function minlength( $minlength ): self {
		$this->minlength = (int) $minlength;
		return $this;
	}

	/**
	 * Get the maxlength value
	 *
	 * @return mixed
	 */
	public function get_maxlength() {
		return $this->maxlength;
	}

	/**
	 * Set the maxlength value
	 *
	 * @param int|string|float $maxlength  The maxlength value
	 * @return self
	 */
	public function maxlength( $maxlength ): self {
		$this->maxlength = (int) $maxlength;
		return $this;
	}
}
